@extends('shop::layouts.app')
@section('title', $supplier->name)
@section('content')
<h1>{{ $supplier->name }}</h1>
<dl class="row">
    <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $supplier->email }}</dd>
    <dt class="col-sm-3">Телефон</dt><dd class="col-sm-9">{{ $supplier->phone ?? '—' }}</dd>
    <dt class="col-sm-3">Страна</dt><dd class="col-sm-9">{{ $supplier->country ?? '—' }}</dd>
    <dt class="col-sm-3">Адрес</dt><dd class="col-sm-9">{{ $supplier->address ?? '—' }}</dd>
    <dt class="col-sm-3">Контакт</dt><dd class="col-sm-9">{{ $supplier->contact_person ?? '—' }}</dd>
    <dt class="col-sm-3">Товаров</dt><dd class="col-sm-9">{{ $supplier->products->count() }}</dd>
</dl>
<a href="{{ route('shop.suppliers.edit', $supplier->id) }}" class="btn btn-warning">Изменить</a>
<form action="{{ route('shop.suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
    @csrf @method('DELETE')
    <button class="btn btn-danger">Удалить</button>
</form>
<a href="{{ route('shop.suppliers.index') }}" class="btn btn-secondary">Назад</a>
@endsection
