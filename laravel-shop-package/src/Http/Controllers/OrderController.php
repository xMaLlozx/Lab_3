<?php

namespace Tukmachev\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tukmachev\Shop\Models\Client;
use Tukmachev\Shop\Models\Order;
use Tukmachev\Shop\Models\Warehouse;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('client', 'warehouse')->paginate(15);
        return view('shop::orders.index', compact('orders'));
    }

    public function create()
    {
        $clients    = Client::all();
        $warehouses = Warehouse::all();
        $statuses   = Order::statuses();
        return view('shop::orders.create', compact('clients', 'warehouses', 'statuses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'          => 'required|exists:shop_clients,id',
            'warehouse_id'       => 'nullable|exists:shop_warehouses,id',
            'status'             => 'required|in:' . implode(',', array_keys(Order::statuses())),
            'total_price'        => 'required|numeric|min:0',
            'delivery_address'   => 'nullable|string',
            'delivery_city'      => 'nullable|string|max:255',
            'delivery_country'   => 'nullable|string|max:100',
            'delivery_latitude'  => 'nullable|numeric|between:-90,90',
            'delivery_longitude' => 'nullable|numeric|between:-180,180',
            'delivery_cost'      => 'nullable|numeric|min:0',
            'notes'              => 'nullable|string',
        ]);

        Order::create($data);
        return redirect()->route('shop.orders.index')->with('success', 'Заказ создан.');
    }

    public function show(Order $order)
    {
        $order->load('client', 'warehouse');
        return view('shop::orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $clients    = Client::all();
        $warehouses = Warehouse::all();
        $statuses   = Order::statuses();
        return view('shop::orders.edit', compact('order', 'clients', 'warehouses', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'client_id'          => 'required|exists:shop_clients,id',
            'warehouse_id'       => 'nullable|exists:shop_warehouses,id',
            'status'             => 'required|in:' . implode(',', array_keys(Order::statuses())),
            'total_price'        => 'required|numeric|min:0',
            'delivery_address'   => 'nullable|string',
            'delivery_city'      => 'nullable|string|max:255',
            'delivery_country'   => 'nullable|string|max:100',
            'delivery_latitude'  => 'nullable|numeric|between:-90,90',
            'delivery_longitude' => 'nullable|numeric|between:-180,180',
            'delivery_cost'      => 'nullable|numeric|min:0',
            'notes'              => 'nullable|string',
        ]);

        $order->update($data);
        return redirect()->route('shop.orders.index')->with('success', 'Заказ обновлён.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('shop.orders.index')->with('success', 'Заказ удалён.');
    }
}
