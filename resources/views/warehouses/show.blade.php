@extends('shop::layouts.app')
@section('title', $warehouse->name)
@section('content')
<h1>{{ $warehouse->name }}</h1>
<dl class="row">
    <dt class="col-sm-3">Адрес</dt><dd class="col-sm-9">{{ $warehouse->address ?? '—' }}</dd>
    <dt class="col-sm-3">Город</dt><dd class="col-sm-9">{{ $warehouse->city ?? '—' }}</dd>
    <dt class="col-sm-3">Страна</dt><dd class="col-sm-9">{{ $warehouse->country ?? '—' }}</dd>
    <dt class="col-sm-3">Координаты</dt><dd class="col-sm-9">{{ $warehouse->latitude }}, {{ $warehouse->longitude }}</dd>
    <dt class="col-sm-3">Вместимость</dt><dd class="col-sm-9">{{ $warehouse->capacity }}</dd>
    <dt class="col-sm-3">Менеджер</dt><dd class="col-sm-9">{{ $warehouse->manager ?? '—' }}</dd>
    <dt class="col-sm-3">Товаров на складе</dt><dd class="col-sm-9">{{ $warehouse->products->count() }}</dd>
</dl>
@if($warehouse->products->count())
<h5>Товары на складе</h5>
<ul>
@foreach($warehouse->products as $p)
    <li>{{ $p->name }} — {{ $p->pivot->quantity }} шт.</li>
@endforeach
</ul>
@endif
<a href="{{ route('shop.warehouses.edit', $warehouse->id) }}" class="btn btn-warning">Изменить</a>
<form action="{{ route('shop.warehouses.destroy', $warehouse->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
    @csrf @method('DELETE')
    <button class="btn btn-danger">Удалить</button>
</form>
<a href="{{ route('shop.warehouses.index') }}" class="btn btn-secondary">Назад</a>
@endsection
