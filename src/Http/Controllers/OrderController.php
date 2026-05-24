<?php

namespace Tukmachev\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tukmachev\Shop\Models\Client;
use Tukmachev\Shop\Models\Order;
use Tukmachev\Shop\Models\Warehouse;
use Tukmachev\Shop\Services\DeliveryCalculatorService;
use Tukmachev\Shop\Services\CurrencyRateService;

class OrderController extends Controller
{
    protected DeliveryCalculatorService $delivery;
    protected CurrencyRateService $currency;

    public function __construct()
    {
        $this->delivery = app('delivery-calculator');
        $this->currency = app('currency-rate');
    }

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

        $data['delivery_cost'] = $this->calculateDeliveryCost($data);

        Order::create($data);
        return redirect()->route('shop.orders.index')->with('success', 'Заказ создан.');
    }

    public function show(Order $order)
    {
        $order->load('client', 'warehouse');

        $totalInRub = null;
        try {
            $totalInRub = $this->currency->convert($order->total_price, 'USD', 'RUB');
        } catch (\Exception $e) {
            // Если API недоступен — не показываем
        }

        return view('shop::orders.show', compact('order', 'totalInRub'));
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

        $data['delivery_cost'] = $this->calculateDeliveryCost($data);

        $order->update($data);
        return redirect()->route('shop.orders.index')->with('success', 'Заказ обновлён.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('shop.orders.index')->with('success', 'Заказ удалён.');
    }

    protected function calculateDeliveryCost(array $data): float
    {
        if (empty($data['delivery_latitude']) || empty($data['delivery_longitude'])) {
            return $data['delivery_cost'] ?? 0;
        }

        if (empty($data['warehouse_id'])) {
            return $data['delivery_cost'] ?? 0;
        }

        $warehouse = Warehouse::find($data['warehouse_id']);

        if (!$warehouse || !$warehouse->latitude || !$warehouse->longitude) {
            return $data['delivery_cost'] ?? 0;
        }

        try {
            $result = $this->delivery->calculate(
                (float) $warehouse->latitude,
                (float) $warehouse->longitude,
                (float) $data['delivery_latitude'],
                (float) $data['delivery_longitude']
            );
            return $result['cost'];
        } catch (\Exception $e) {
            return $data['delivery_cost'] ?? 0;
        }
    }
}
