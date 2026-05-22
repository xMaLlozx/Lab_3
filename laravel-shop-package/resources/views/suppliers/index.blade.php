@extends('shop::layouts.app')
@section('title', 'Поставщики')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Поставщики</h1>
    <a href="{{ route('shop.suppliers.create') }}" class="btn btn-primary">+ Добавить</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Название</th><th>Email</th><th>Страна</th><th>Контакт</th><th>Действия</th></tr>
    </thead>
    <tbody>
    @forelse($suppliers as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->country ?? '—' }}</td>
            <td>{{ $s->contact_person ?? '—' }}</td>
            <td>
                <a href="{{ route('shop.suppliers.show', $s) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('shop.suppliers.edit', $s) }}" class="btn btn-sm btn-warning">Изменить</a>
                <form action="{{ route('shop.suppliers.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center">Нет поставщиков</td></tr>
    @endforelse
    </tbody>
</table>
{{ $suppliers->links() }}
@endsection
