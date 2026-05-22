@extends('shop::layouts.app')
@section('title', 'Добавить склад')
@section('content')
<h1>Добавить склад</h1>
<form action="{{ route('shop.warehouses.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Название *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
            <div class="mb-3"><label class="form-label">Адрес</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea></div>
            <div class="mb-3"><label class="form-label">Город</label>
                <input type="text" name="city" class="form-control" value="{{ old('city') }}"></div>
            <div class="mb-3"><label class="form-label">Страна</label>
                <input type="text" name="country" class="form-control" value="{{ old('country') }}"></div>
        </div>
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Широта</label>
                <input type="number" step="0.000001" name="latitude" class="form-control" value="{{ old('latitude') }}"></div>
            <div class="mb-3"><label class="form-label">Долгота</label>
                <input type="number" step="0.000001" name="longitude" class="form-control" value="{{ old('longitude') }}"></div>
            <div class="mb-3"><label class="form-label">Вместимость</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', 0) }}"></div>
            <div class="mb-3"><label class="form-label">Менеджер</label>
                <input type="text" name="manager" class="form-control" value="{{ old('manager') }}"></div>
        </div>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="{{ route('shop.warehouses.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
