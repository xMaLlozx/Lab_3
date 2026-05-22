@extends('shop::layouts.app')
@section('title', 'Создать категорию')
@section('content')
<h1>Создать категорию</h1>
<form action="{{ route('shop.categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Название *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Slug *</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Родительская категория</label>
        <select name="parent_id" class="form-select">
            <option value="">— нет —</option>
            @foreach($parents as $p)
                <option value="{{ $p->id }}" {{ old('parent_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="{{ route('shop.categories.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
