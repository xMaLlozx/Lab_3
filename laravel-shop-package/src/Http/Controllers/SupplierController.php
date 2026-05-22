<?php

namespace Tukmachev\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tukmachev\Shop\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(15);
        return view('shop::suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('shop::suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:shop_suppliers,email',
            'phone'          => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'country'        => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
        ]);

        Supplier::create($data);
        return redirect()->route('shop.suppliers.index')->with('success', 'Поставщик создан.');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load('products');
        return view('shop::suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('shop::suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:shop_suppliers,email,' . $supplier->id,
            'phone'          => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'country'        => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:255',
        ]);

        $supplier->update($data);
        return redirect()->route('shop.suppliers.index')->with('success', 'Поставщик обновлён.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('shop.suppliers.index')->with('success', 'Поставщик удалён.');
    }
}
