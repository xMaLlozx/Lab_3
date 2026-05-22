@extends('shop::layouts.app')
@section('title', 'Редактировать клиента')
@section('content')
<h1>Редактировать: {{ $client->name }}</h1>
<form action="{{ route('shop.clients.update', $client) }}" method="POST">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Имя *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required></div>
            <div class="mb-3"><label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}" required></div>
            <div class="mb-3"><label class="form-label">Телефон</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}"></div>
        </div>
        <div class="col-md-6">
            <div class="mb-3"><label class="form-label">Адрес</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $client->address) }}"></div>
            <div class="mb-3"><label class="form-label">Город</label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $client->city) }}"></div>
            <div class="mb-3"><label class="form-label">Страна</label>
                <input type="text" name="country" class="form-control" value="{{ old('country', $client->country) }}"></div>
            <div class="mb-3"><label class="form-label">Индекс</label>
                <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $client->postal_code) }}"></div>
        </div>
    </div>
    <button class="btn btn-primary">Обновить</button>
    <a href="{{ route('shop.clients.index') }}" class="btn btn-secondary">Назад</a>
</form>
@endsection
