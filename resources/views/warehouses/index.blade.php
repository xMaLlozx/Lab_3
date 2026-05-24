@extends('shop::layouts.app')
@section('title', 'Склады')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Склады</h1>
    <a href="{{ route('shop.warehouses.create') }}" class="btn btn-primary">+ Добавить</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Название</th><th>Город</th><th>Страна</th><th>Вместимость</th><th>Менеджер</th><th>Действия</th></tr>
    </thead>
    <tbody>
    @forelse($warehouses as $w)
        <tr>
            <td>{{ $w->id }}</td>
            <td>{{ $w->name }}</td>
            <td>{{ $w->city ?? '—' }}</td>
            <td>{{ $w->country ?? '—' }}</td>
            <td>{{ $w->capacity }}</td>
            <td>{{ $w->manager ?? '—' }}</td>
            <td>
                <a href="{{ route('shop.warehouses.show', $w->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('shop.warehouses.edit', $w->id) }}" class="btn btn-sm btn-warning">Изменить</a>
                <form action="{{ route('shop.warehouses.destroy', $w->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">Нет складов</td></tr>
    @endforelse
    </tbody>
</table>
{{ $warehouses->links("pagination::bootstrap-5") }}
@endsection
