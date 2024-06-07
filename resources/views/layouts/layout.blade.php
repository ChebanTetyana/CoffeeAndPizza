<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta name="user-id" content="{{ auth()->user()->id }}">--}}
    @if (auth()->check())
        <meta name="user-id" content="{{ auth()->user()->id }}">
    @endif

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @auth
        <script src="{{ asset('js/cartState.js') }}"></script>
    @endauth
</head>
<style>
    body {
        color: #136d43;
    }
    .about .container-custom {
        background-color: #198754ba;
        color: #fff;
    }
    :root {
        --teal-300: #20c997;
    }
    .container-custom {
        max-width: 960px;
        margin-left: auto;
        margin-right: auto;
    }
    .about {
        background-image: url('{{ asset('images/pizza_1.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 50px;
        height: 100vh;
    }
    .home {
        background-image:url('{{ asset('images/home.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 50px;
        height: 100vh;
    }
    .pizza {
        background-image: url('{{ asset('images/pizza.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 50px;
        /*height: 100vh;*/
    }
    .coffee {
        background-image: url('{{ asset('images/coffee.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 50px;
        height: 100vh;
    }
    .menu {
        background-image:url('{{ asset('images/menu.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 50px;
        /*height: 100vh;*/
    }
    .cart {
        background-image:url('{{ asset('images/cart.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 50px;
        height: 100vh;
    }
    .cart-icon {
        position: relative;
        display: inline-block;
        color: var(--teal-300);
        text-decoration: none;
    }
    .cart-icon .fa-shopping-cart {
        font-size: 24px;
    }
    .cart-count {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: orangered;
        color: white;
        border-radius: 50%;
        padding: 4px 8px;
        font-size: 12px;
    }
    .dropdown-menu {
        background-color: #198754c2;
    }
    .dropdown-item {
        color: #fff;
    }
    .form-group {
        display: flex;
        align-items: center;
        gap: 1rem;
        width: 50%;
        margin: 0 auto;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-custom">
            <div class="d-flex justify-content-center">
                <a class="navbar-brand" href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav gap-5 fs-4 mx-auto text-center" style="--color: var(--teal-300); color: var(--color);">
                        @auth
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->is('menu*') ? 'active' : '' }}"
                                   href="#"
                                   id="navbarDropdown"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false"
                                   style="--color: var(--teal-300)">Menu
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item fs-3" href="/menu/pizza">Pizza</a></li>
                                    <li><a class="dropdown-item fs-3" href="/menu/coffee">Coffee</a></li>
                                </ul>
                            </div>
                        @endauth
                            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">About</a>
                        @auth
                            <a class="nav-link cart-icon align-content-center {{ request()->is('cart') ? 'active' : '' }}" href="/cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="cart-count" id="cartCount">0</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex m-auto" role="search">
                                @csrf
                                @method('DELETE')
                                <button id="logout-button" class="btn" type="submit" style="background-color: orangered; color: var(--color);">Logout</button>
                            </form>
                        @endauth
                        @if (!auth()->check())
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">Login</a>
                            <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="/register">Registration</a>
                        @else
                            <p class="cart-icon m-auto">Welcome, {{ auth()->user()->name }}!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
{{--    @auth--}}
{{--    <div class="container-custom">--}}
{{--        <h1>Welcome, {{ Auth::user()->name }}</h1>--}}
{{--    </div>--}}
{{--    @endauth--}}
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

</body>
</html>


