@extends('shop::layouts.app')
@section('title', 'Редактировать категорию')
@section('content')
<h1>Редактировать: {{ $category->name }}</h1>
<form action="{{ route('shop.categories.update', $category) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Название *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Slug *</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Родительская категория</label>
        <select name="parent_id" class="form-select">
            <option value="">— нет —</option>
            @foreach($parents as $p)
                <option value="{{ $p->id }}" {{ old('parent_id', $category->parent_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Обновить</button>
    <a href="{{ route('shop.categories.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
