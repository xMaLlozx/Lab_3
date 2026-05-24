@extends('shop::layouts.app')
@section('title', 'Заказ #' . $order->id)
@section('content')
<h1>Заказ #{{ $order->id }}</h1>
<dl class="row">
    <dt class="col-sm-3">Клиент</dt><dd class="col-sm-9">{{ $order->client?->name ?? '—' }}</dd>
    <dt class="col-sm-3">Склад</dt><dd class="col-sm-9">{{ $order->warehouse?->name ?? '—' }}</dd>
    <dt class="col-sm-3">Статус</dt>
    <dd class="col-sm-9"><span class="badge bg-secondary">{{ \Tukmachev\Shop\Models\Order::statuses()[$order->status] ?? $order->status }}</span></dd>
    <dt class="col-sm-3">Сумма</dt><dd class="col-sm-9">{{ number_format($order->total_price, 2) }}</dd>
    <dt class="col-sm-3">Доставка</dt><dd class="col-sm-9">{{ number_format($order->delivery_cost, 2) }}</dd>
    <dt class="col-sm-3">Адрес доставки</dt><dd class="col-sm-9">{{ $order->delivery_address ?? '—' }}, {{ $order->delivery_city ?? '' }}, {{ $order->delivery_country ?? '' }}</dd>
    <dt class="col-sm-3">Координаты</dt><dd class="col-sm-9">{{ $order->delivery_latitude }}, {{ $order->delivery_longitude }}</dd>
    <dt class="col-sm-3">Примечания</dt><dd class="col-sm-9">{{ $order->notes ?? '—' }}</dd>
    <dt class="col-sm-3">Создан</dt><dd class="col-sm-9">{{ $order->created_at->format('d.m.Y H:i') }}</dd>
</dl>
<a href="{{ route('shop.orders.edit', $order->id) }}" class="btn btn-warning">Изменить</a>
<form action="{{ route('shop.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
    @csrf @method('DELETE')
    <button class="btn btn-danger">Удалить</button>
</form>
<a href="{{ route('shop.orders.index') }}" class="btn btn-secondary">Назад</a>
@endsection
