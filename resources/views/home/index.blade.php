@extends('layouts.layout')
@section('title', 'Home')
@section('content')
    <div class="container-custom">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($menuItems as $menuItem)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $menuItem->image) }}" class="card-img-top" alt="{{ $menuItem->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $menuItem->name }}</h5>
                            <p class="card-text">{{ $menuItem->description }}</p>
                            <a href="#" class="btn btn-success">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
