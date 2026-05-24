<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Интернет-магазин') — Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        svg { max-width: 100%; max-height: 2em; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('shop.products.index') }}">Shop</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.products.index') }}">Товары</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.categories.index') }}">Категории</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.suppliers.index') }}">Поставщики</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.clients.index') }}">Клиенты</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.warehouses.index') }}">Склады</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.orders.index') }}">Заказы</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(isset($errors) && $errors->count() > 0)
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    @yield('content')
</div>
</body>
</html>
