@extends('shop::layouts.app')
@section('title', 'Товары')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Товары</h1>
    <a href="{{ route('shop.products.create') }}" class="btn btn-primary">+ Добавить</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Название</th><th>Цена</th><th>Склад</th><th>Категория</th><th>Активен</th><th>Действия</th></tr>
    </thead>
    <tbody>
    @forelse($products as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ number_format($p->price, 2) }}</td>
            <td>{{ $p->stock }}</td>
            <td>{{ $p->category?->name ?? '—' }}</td>
            <td>{{ $p->is_active ? 'Да' : 'Нет' }}</td>
            <td>
                <a href="{{ route('shop.products.show', $p->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('shop.products.edit', $p->id) }}" class="btn btn-sm btn-warning">Изменить</a>
                <form action="{{ route('shop.products.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">Нет товаров</td></tr>
    @endforelse
    </tbody>
</table>
{{ $products->links("pagination::bootstrap-5") }}
@endsection
