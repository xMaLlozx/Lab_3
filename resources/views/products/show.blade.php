@extends('shop::layouts.app')
@section('title', $product->name)
@section('content')
<h1>{{ $product->name }}</h1>
<dl class="row">
    <dt class="col-sm-3">SKU</dt><dd class="col-sm-9">{{ $product->sku ?? '—' }}</dd>
    <dt class="col-sm-3">Цена</dt><dd class="col-sm-9">{{ number_format($product->price, 2) }}</dd>
    <dt class="col-sm-3">Остаток</dt><dd class="col-sm-9">{{ $product->stock }}</dd>
    <dt class="col-sm-3">Вес</dt><dd class="col-sm-9">{{ $product->weight ? $product->weight . ' кг' : '—' }}</dd>
    <dt class="col-sm-3">Категория</dt><dd class="col-sm-9">{{ $product->category?->name ?? '—' }}</dd>
    <dt class="col-sm-3">Поставщик</dt><dd class="col-sm-9">{{ $product->supplier?->name ?? '—' }}</dd>
    <dt class="col-sm-3">Активен</dt><dd class="col-sm-9">{{ $product->is_active ? 'Да' : 'Нет' }}</dd>
    <dt class="col-sm-3">Описание</dt><dd class="col-sm-9">{{ $product->description ?? '—' }}</dd>
</dl>
<a href="{{ route('shop.products.edit', $product->id) }}" class="btn btn-warning">Изменить</a>
<form action="{{ route('shop.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
    @csrf @method('DELETE')
    <button class="btn btn-danger">Удалить</button>
</form>
<a href="{{ route('shop.products.index') }}" class="btn btn-secondary">Назад</a>
@endsection
