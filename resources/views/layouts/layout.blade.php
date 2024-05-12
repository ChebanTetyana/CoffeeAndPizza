<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="{{ asset('js/cartState.js') }}"></script>
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
        background-image: url('images/pizza_1.jpg');
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
    /*.cart-icon  {*/
    /*    !*padding-top: 0.7rem;*!*/
    /*    position: relative;*/
    /*}*/
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
    /*.select-custom {*/
    /*    appearance: none;*/
    /*    -webkit-appearance: none;*/
    /*    -moz-appearance: none;*/
    /*    border: 1px solid green;*/
    /*    padding: 5px 10px;*/
    /*    background-color: transparent;*/
    /*    cursor: pointer;*/
    /*}*/
    /*.select-custom option {*/
    /*    background-color: transparent;*/
    /*}*/
    /*.select-custom option:hover {*/
    /*    background-color: green;*/
    /*    color: white;*/
    /*}*/
    /*.select-custom option:checked {*/
    /*    background-color: darkgreen;*/
    /*    color: white;*/
    /*}*/

</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-custom">
            <div class="d-flex justify-content-center">
                <a class="navbar-brand" href="/"><img src="{{ asset('images/logo.png') }}"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav gap-5 fs-4 mx-auto text-center">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/" style="--color: var(--teal-300)">Home</a>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->is('menu*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="--color: var(--teal-300)">
                                Menu
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="/menu/pizza">Pizza</a></li>
                                    <li><a class="dropdown-item" href="/menu/coffee">Coffee</a></li>
                                </ul>
                            </div>
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about" style="--color: var(--teal-300)">About</a>
                        <a class="nav-link cart-icon align-content-center {{ request()->is('cart') ? 'active' : '' }}" href="/cart" >
                            <i class="fa fa-shopping-cart"></i>
{{--                            @if($cartItemsCount > 0)--}}
                                <span class="cart-count" id="cartCount">0</span>
{{--                           @endif--}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

</body>
</html>


