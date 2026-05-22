@extends('shop::layouts.app')
@section('title', 'Заказы')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Заказы</h1>
    <a href="{{ route('shop.orders.create') }}" class="btn btn-primary">+ Добавить</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Клиент</th><th>Склад</th><th>Статус</th><th>Сумма</th><th>Доставка</th><th>Действия</th></tr>
    </thead>
    <tbody>
    @forelse($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->client?->name ?? '—' }}</td>
            <td>{{ $o->warehouse?->name ?? '—' }}</td>
            <td><span class="badge bg-secondary">{{ \Tukmachev\Shop\Models\Order::statuses()[$o->status] ?? $o->status }}</span></td>
            <td>{{ number_format($o->total_price, 2) }}</td>
            <td>{{ number_format($o->delivery_cost, 2) }}</td>
            <td>
                <a href="{{ route('shop.orders.show', $o) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('shop.orders.edit', $o) }}" class="btn btn-sm btn-warning">Изменить</a>
                <form action="{{ route('shop.orders.destroy', $o) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">Нет заказов</td></tr>
    @endforelse
    </tbody>
</table>
{{ $orders->links() }}
@endsection
