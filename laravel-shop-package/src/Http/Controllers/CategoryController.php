<?php

namespace Tukmachev\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tukmachev\Shop\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->paginate(15);
        return view('shop::categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->get();
        return view('shop::categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|unique:shop_categories,slug',
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:shop_categories,id',
        ]);

        Category::create($data);
        return redirect()->route('shop.categories.index')->with('success', 'Категория создана.');
    }

    public function show(Category $category)
    {
        $category->load('parent', 'children', 'products');
        return view('shop::categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        return view('shop::categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|unique:shop_categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:shop_categories,id',
        ]);

        $category->update($data);
        return redirect()->route('shop.categories.index')->with('success', 'Категория обновлена.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('shop.categories.index')->with('success', 'Категория удалена.');
    }
}
