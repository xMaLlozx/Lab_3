@extends('shop::layouts.app')
@section('title', 'Редактировать заказ #' . $order->id)
@section('content')
<h1>Редактировать заказ #{{ $order->id }}</h1>
<form action="{{ route('shop.orders.update', $order) }}" method="POST">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Клиент *</label>
                <select name="client_id" class="form-select" required>
                    @foreach($clients as $c)
                        <option value="{{ $c->id }}" {{ old('client_id', $order->client_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3"><label class="form-label">Склад</label>
                <select name="warehouse_id" class="form-select">
                    <option value="">— нет —</option>
                    @foreach($warehouses as $w)
                        <option value="{{ $w->id }}" {{ old('warehouse_id', $order->warehouse_id) == $w->id ? 'selected' : '' }}>{{ $w->name }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3"><label class="form-label">Статус *</label>
                <select name="status" class="form-select" required>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $order->status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3"><label class="form-label">Сумма заказа *</label>
                <input type="number" step="0.01" name="total_price" class="form-control" value="{{ old('total_price', $order->total_price) }}" required></div>
            <div class="mb-3"><label class="form-label">Стоимость доставки</label>
                <input type="number" step="0.01" name="delivery_cost" class="form-control" value="{{ old('delivery_cost', $order->delivery_cost) }}"></div>
        </div>
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Адрес доставки</label>
                <input type="text" name="delivery_address" class="form-control" value="{{ old('delivery_address', $order->delivery_address) }}"></div>
            <div class="mb-3"><label class="form-label">Город доставки</label>
                <input type="text" name="delivery_city" class="form-control" value="{{ old('delivery_city', $order->delivery_city) }}"></div>
            <div class="mb-3"><label class="form-label">Страна доставки</label>
                <input type="text" name="delivery_country" class="form-control" value="{{ old('delivery_country', $order->delivery_country) }}"></div>
            <div class="mb-3"><label class="form-label">Широта (доставка)</label>
                <input type="number" step="0.000001" name="delivery_latitude" class="form-control" value="{{ old('delivery_latitude', $order->delivery_latitude) }}"></div>
            <div class="mb-3"><label class="form-label">Долгота (доставка)</label>
                <input type="number" step="0.000001" name="delivery_longitude" class="form-control" value="{{ old('delivery_longitude', $order->delivery_longitude) }}"></div>
            <div class="mb-3"><label class="form-label">Примечания</label>
                <textarea name="notes" class="form-control" rows="3">{{ old('notes', $order->notes) }}</textarea></div>
        </div>
    </div>
    <button class="btn btn-primary">Обновить</button>
    <a href="{{ route('shop.orders.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
