@extends('layouts.layout')
@section('title', 'Pizza')
@section('content')
    <div class="pizza">
        <div class="container-custom">
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
                                <div class="form-group d-flex mt-auto mb-3">
                                    <label for="sizeSelect{{ $menuItem->id }}">Size:</label>
                                    <select class="form-select select-custom size-select text-success" id="sizeSelect{{ $menuItem->id }}">
                                        <option value="S">S</option>
                                        <option value="M" selected>M</option>
                                        <option value="L">L</option>
                                    </select>
                                </div>
                                <div>
                                    <p id="price{{ $menuItem->id }}" class="card-price ">Price: ${{ $menuItem->price }}</p>
                                    <button type="button" class="btn btn-success mt-auto addToCart"
                                            data-product-id="{{ $menuItem->id }}"
                                            data-size="M"
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
