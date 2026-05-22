<?php

namespace Tukmachev\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Tukmachev\Shop\Models\Category;
use Tukmachev\Shop\Models\Product;
use Tukmachev\Shop\Models\Supplier;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'supplier')->paginate(15);
        return view('shop::products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('shop::products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'nullable|string|unique:shop_products,sku',
            'category_id' => 'nullable|exists:shop_categories,id',
            'supplier_id' => 'nullable|exists:shop_suppliers,id',
            'weight'      => 'nullable|numeric|min:0',
            'is_active'   => 'boolean',
        ]);

        $data['slug']      = Str::slug($data['name']) . '-' . uniqid();
        $data['is_active'] = $request->boolean('is_active', true);

        Product::create($data);
        return redirect()->route('shop.products.index')->with('success', 'Товар создан.');
    }

    public function show(Product $product)
    {
        $product->load('category', 'supplier');
        return view('shop::products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('shop::products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'sku'         => 'nullable|string|unique:shop_products,sku,' . $product->id,
            'category_id' => 'nullable|exists:shop_categories,id',
            'supplier_id' => 'nullable|exists:shop_suppliers,id',
            'weight'      => 'nullable|numeric|min:0',
            'is_active'   => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);
        return redirect()->route('shop.products.index')->with('success', 'Товар обновлён.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('shop.products.index')->with('success', 'Товар удалён.');
    }
}
