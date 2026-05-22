@extends('shop::layouts.app')
@section('title', 'Добавить поставщика')
@section('content')
<h1>Добавить поставщика</h1>
<form action="{{ route('shop.suppliers.store') }}" method="POST">
    @csrf
    <div class="mb-3"><label class="form-label">Название *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
    <div class="mb-3"><label class="form-label">Email *</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
    <div class="mb-3"><label class="form-label">Телефон</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"></div>
    <div class="mb-3"><label class="form-label">Адрес</label>
        <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea></div>
    <div class="mb-3"><label class="form-label">Страна</label>
        <input type="text" name="country" class="form-control" value="{{ old('country') }}"></div>
    <div class="mb-3"><label class="form-label">Контактное лицо</label>
        <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person') }}"></div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="{{ route('shop.suppliers.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
