@extends('shop::layouts.app')
@section('title', 'Категории')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Категории</h1>
    <a href="{{ route('shop.categories.create') }}" class="btn btn-primary">+ Добавить</a>
</div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Название</th><th>Родитель</th><th>Описание</th><th>Действия</th></tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->parent?->name ?? '—' }}</td>
            <td>{{ Str::limit($category->description, 60) }}</td>
            <td>
                <a href="{{ route('shop.categories.show', $category->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('shop.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Изменить</a>
                <form action="{{ route('shop.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Нет категорий</td></tr>
    @endforelse
    </tbody>
</table>
{{ $categories->links("pagination::bootstrap-5") }}
@endsection
