@extends('layouts.layout')
@section('title', 'Cart')
@section('content')
<div class="cart">
    <div class="container-custom">
        <div class="text-center">
            @if($cartItems->isEmpty())
                <p class="fs-3 m-3">Nothing has been added yet.</p>
                <a href="{{ route('menu.index') }}" class="btn btn-success m-3">I want to eat</a>
            @else
        </div>
        <h1 class="text-center m-3">Order</h1>
        <table class="table">
            <tbody>
            @foreach($cartItems as $cartItem)
                <tr data-id="{{ $cartItem->id }}" data-product_type="{{ $cartItem->product_type }}">
                    <td><img src="{{ asset('images/' . $cartItem->image) }}"
                             alt="{{ $cartItem->name }}"
                             style=" max-width: 100px;">
                    </td>
                    <td class="align-middle" data-name="{{ $cartItem->name }}" id="productName">{{ $cartItem->name }}</td>
                    <td class="align-middle">{{ $cartItem->size }}</td>
                    <td class="align-middle price-per-item" data-id="{{ $cartItem->id }}">{{ $cartItem->price }}</td>
                    <td class="align-middle">
                        <button class="btn btn-sm btn-success decrease-btn" data-id="{{ $cartItem->id }}">-</button>
                        <span class="count">{{ $cartItem->count }}</span>
                        <button class="btn btn-sm btn-success increase-btn" data-id="{{ $cartItem->id }}">+</button>
                    </td>
                    <td class="align-middle total-price" data-id="{{ $cartItem->id }}">{{ number_format($totalPricePerItems[$cartItem->id], 2) }}</td>
                    <td class="align-middle">
                        <form action="{{ route('cart.delete', ['id' => $cartItem->id]) }}" method="POST" class="m-0">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link text-danger">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
        <div class="text-center">
            <h2 class="m-3" id="totalPrice">Total price: {{ number_format($totalPrice, 2) }}</h2>
            <a class="btn btn-success"
               id="createOrderButton"
               data-bs-toggle="modal"
               data-bs-target="#orderModal">Create order
            </a>
        </div>
    </div>

    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Your Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="orderDetails"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="modalOkButton">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="{{ asset('js/counter.js') }}"></script>
<script src="{{ asset('js/order.js') }}"></script>
