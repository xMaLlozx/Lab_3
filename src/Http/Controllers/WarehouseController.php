<?php

namespace Tukmachev\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tukmachev\Shop\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::paginate(15);
        return view('shop::warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('shop::warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'nullable|string',
            'city'      => 'nullable|string|max:255',
            'country'   => 'nullable|string|max:100',
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'capacity'  => 'nullable|integer|min:0',
            'manager'   => 'nullable|string|max:255',
        ]);

        Warehouse::create($data);
        return redirect()->route('shop.warehouses.index')->with('success', 'Склад создан.');
    }

    public function show(Warehouse $warehouse)
    {
        $warehouse->load('products', 'orders');
        return view('shop::warehouses.show', compact('warehouse'));
    }

    public function edit(Warehouse $warehouse)
    {
        return view('shop::warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'nullable|string',
            'city'      => 'nullable|string|max:255',
            'country'   => 'nullable|string|max:100',
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'capacity'  => 'nullable|integer|min:0',
            'manager'   => 'nullable|string|max:255',
        ]);

        $warehouse->update($data);
        return redirect()->route('shop.warehouses.index')->with('success', 'Склад обновлён.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('shop.warehouses.index')->with('success', 'Склад удалён.');
    }
}
