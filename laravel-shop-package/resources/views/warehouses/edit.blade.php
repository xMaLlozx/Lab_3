@extends('shop::layouts.app')
@section('title', 'Редактировать склад')
@section('content')
<h1>Редактировать: {{ $warehouse->name }}</h1>
<form action="{{ route('shop.warehouses.update', $warehouse) }}" method="POST">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Название *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $warehouse->name) }}" required></div>
            <div class="mb-3"><label class="form-label">Адрес</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address', $warehouse->address) }}</textarea></div>
            <div class="mb-3"><label class="form-label">Город</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $warehouse->city) }}"></div>
            <div class="mb-3"><label class="form-label">Страна</label>
                <input type="text" name="country" class="form-control" value="{{ old('country', $warehouse->country) }}"></div>
        </div>
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Широта</label>
                <input type="number" step="0.000001" name="latitude" class="form-control" value="{{ old('latitude', $warehouse->latitude) }}"></div>
            <div class="mb-3"><label class="form-label">Долгота</label>
                <input type="number" step="0.000001" name="longitude" class="form-control" value="{{ old('longitude', $warehouse->longitude) }}"></div>
            <div class="mb-3"><label class="form-label">Вместимость</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $warehouse->capacity) }}"></div>
            <div class="mb-3"><label class="form-label">Менеджер</label>
                <input type="text" name="manager" class="form-control" value="{{ old('manager', $warehouse->manager) }}"></div>
        </div>
    </div>
    <button class="btn btn-primary">Обновить</button>
    <a href="{{ route('shop.warehouses.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
