@extends('shop::layouts.app')
@section('title', $client->name)
@section('content')
<h1>{{ $client->name }}</h1>
<dl class="row">
    <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $client->email }}</dd>
    <dt class="col-sm-3">Телефон</dt><dd class="col-sm-9">{{ $client->phone ?? '—' }}</dd>
    <dt class="col-sm-3">Адрес</dt><dd class="col-sm-9">{{ $client->address ?? '—' }}</dd>
    <dt class="col-sm-3">Город</dt><dd class="col-sm-9">{{ $client->city ?? '—' }}</dd>
    <dt class="col-sm-3">Страна</dt><dd class="col-sm-9">{{ $client->country ?? '—' }}</dd>
    <dt class="col-sm-3">Индекс</dt><dd class="col-sm-9">{{ $client->postal_code ?? '—' }}</dd>
    <dt class="col-sm-3">Заказов</dt><dd class="col-sm-9">{{ $client->orders->count() }}</dd>
</dl>
<a href="{{ route('shop.clients.edit', $client->id) }}" class="btn btn-warning">Изменить</a>
<form action="{{ route('shop.clients.destroy', $client->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
    @csrf @method('DELETE')
    <button class="btn btn-danger">Удалить</button>
</form>
<a href="{{ route('shop.clients.index') }}" class="btn btn-secondary">Назад</a>
@endsection
