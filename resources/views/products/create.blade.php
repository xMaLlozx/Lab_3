@extends('shop::layouts.app')
@section('title', 'Добавить товар')
@section('content')
<h1>Добавить товар</h1>
<form action="{{ route('shop.products.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3"><label class="form-label">Название *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
            <div class="mb-3"><label class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea></div>
            <div class="mb-3"><label class="form-label">SKU</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}"></div>
        </div>
        <div class="col-md-4">
            <div class="mb-3"><label class="form-label">Цена *</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required></div>
            <div class="mb-3"><label class="form-label">Остаток *</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" required></div>
            <div class="mb-3"><label class="form-label">Вес (кг)</label>
                <input type="number" step="0.001" name="weight" class="form-control" value="{{ old('weight') }}"></div>
            <div class="mb-3"><label class="form-label">Категория</label>
                <select name="category_id" class="form-select">
                    <option value="">— выберите —</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3"><label class="form-label">Поставщик</label>
                <select name="supplier_id" class="form-select">
                    <option value="">— выберите —</option>
                    @foreach($suppliers as $s)
                        <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Активен</label></div>
        </div>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="{{ route('shop.products.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
