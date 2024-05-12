@extends('layouts.layout')
@section('title', 'Cart')
@section('content')
{{--    @dd($cartItems);--}}
    <div class="container-custom">
        @if($cartItems->isEmpty())

            <p>Nothing has been added yet.</p>
            <a href="{{ route('menu.index') }}" class="btn btn-primary">I want to eat</a>
        @else
            <h1>Order</h1>
            <ul>
                @foreach($cartItems as $cartItem)
                    <li>{{ $cartItem->name }} - {{ $cartItem->price }}</li>
                @endforeach
            </ul>
            <h2>Total price: {{ $totalPrice }}</h2>
            <a href="{{ route('order.create') }}" class="btn btn-primary">Create order</a>
        @endif
    </div>

@endsection

