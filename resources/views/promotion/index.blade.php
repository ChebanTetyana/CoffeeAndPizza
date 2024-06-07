@extends('layouts.layout')
@section('title', 'Promotion')
@section('content')
    <div class="home">
        <div class="container-custom">
            <h2 class="text-center mb-5">Promotions</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                @foreach($menuItems as $menuItem)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('images/' . $menuItem->image) }}" class="card-img-top" alt="{{ $menuItem->name }}">
                            <div class="card-body d-flex flex-column text-center">
                                <div class="mb-3">
                                    <h5 class="card-title">{{ $menuItem->name }}</h5>
                                    <p class="card-text mt-auto">{{ $menuItem->description }}</p>
                                </div>
                                <div>
                                    <p id="price{{ $menuItem->id }}" class="card-price">Price: ${{ $menuItem->price }}</p>
                                    <button type="button" class="btn btn-success mt-auto addToCart"
                                        data-product-id="{{ $menuItem->id }}"
                                        data-product-type="{{ $menuItem->product_type }}"
                                        data-price="{{ $menuItem->price }}"
                                        data-route="{{ route('cart.index') }}">Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/menu.js') }}"></script>

