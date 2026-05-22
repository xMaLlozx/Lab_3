@extends('shop::layouts.app')
@section('title', 'Редактировать товар')
@section('content')
<h1>Редактировать: {{ $product->name }}</h1>
<form action="{{ route('shop.products.update', $product) }}" method="POST">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3"><label class="form-label">Название *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required></div>
            <div class="mb-3"><label class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea></div>
            <div class="mb-3"><label class="form-label">SKU</label>
                <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}"></div>
        </div>
        <div class="col-md-4">
            <div class="mb-3"><label class="form-label">Цена *</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required></div>
            <div class="mb-3"><label class="form-label">Остаток *</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required></div>
            <div class="mb-3"><label class="form-label">Вес (кг)</label>
                <input type="number" step="0.001" name="weight" class="form-control" value="{{ old('weight', $product->weight) }}"></div>
            <div class="mb-3"><label class="form-label">Категория</label>
                <select name="category_id" class="form-select">
                    <option value="">— выберите —</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3"><label class="form-label">Поставщик</label>
                <select name="supplier_id" class="form-select">
                    <option value="">— выберите —</option>
                    @foreach($suppliers as $s)
                        <option value="{{ $s->id }}" {{ old('supplier_id', $product->supplier_id) == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Активен</label></div>
        </div>
    </div>
    <button class="btn btn-primary">Обновить</button>
    <a href="{{ route('shop.products.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
