@extends('shop::layouts.app')
@section('title', 'Редактировать поставщика')
@section('content')
<h1>Редактировать: {{ $supplier->name }}</h1>
<form action="{{ route('shop.suppliers.update', $supplier) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Название *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $supplier->name) }}" required></div>
    <div class="mb-3"><label class="form-label">Email *</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $supplier->email) }}" required></div>
    <div class="mb-3"><label class="form-label">Телефон</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}"></div>
    <div class="mb-3"><label class="form-label">Адрес</label>
        <textarea name="address" class="form-control" rows="2">{{ old('address', $supplier->address) }}</textarea></div>
    <div class="mb-3"><label class="form-label">Страна</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $supplier->country) }}"></div>
    <div class="mb-3"><label class="form-label">Контактное лицо</label>
        <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $supplier->contact_person) }}"></div>
    <button class="btn btn-primary">Обновить</button>
    <a href="{{ route('shop.suppliers.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
