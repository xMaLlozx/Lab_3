@extends('shop::layouts.app')
@section('title', $category->name)
@section('content')
<h1>{{ $category->name }}</h1>
<dl class="row">
    <dt class="col-sm-3">Slug</dt><dd class="col-sm-9">{{ $category->slug }}</dd>
    <dt class="col-sm-3">Родитель</dt><dd class="col-sm-9">{{ $category->parent?->name ?? '—' }}</dd>
    <dt class="col-sm-3">Описание</dt><dd class="col-sm-9">{{ $category->description ?? '—' }}</dd>
    <dt class="col-sm-3">Подкатегории</dt><dd class="col-sm-9">{{ $category->children->pluck('name')->join(', ') ?: '—' }}</dd>
    <dt class="col-sm-3">Товаров</dt><dd class="col-sm-9">{{ $category->products->count() }}</dd>
</dl>
<a href="{{ route('shop.categories.edit', $category->id) }}" class="btn btn-warning">Изменить</a>
<form action="{{ route('shop.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
    @csrf @method('DELETE')
    <button class="btn btn-danger">Удалить</button>
</form>
<a href="{{ route('shop.categories.index') }}" class="btn btn-secondary">Назад</a>
@endsection
