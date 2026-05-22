@extends('shop::layouts.app')
@section('title', 'Клиенты')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Клиенты</h1>
    <a href="{{ route('shop.clients.create') }}" class="btn btn-primary">+ Добавить</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Имя</th><th>Email</th><th>Город</th><th>Страна</th><th>Действия</th></tr>
    </thead>
    <tbody>
    @forelse($clients as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->name }}</td>
            <td>{{ $c->email }}</td>
            <td>{{ $c->city ?? '—' }}</td>
            <td>{{ $c->country ?? '—' }}</td>
            <td>
                <a href="{{ route('shop.clients.show', $c) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('shop.clients.edit', $c) }}" class="btn btn-sm btn-warning">Изменить</a>
                <form action="{{ route('shop.clients.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center">Нет клиентов</td></tr>
    @endforelse
    </tbody>
</table>
{{ $clients->links() }}
@endsection
