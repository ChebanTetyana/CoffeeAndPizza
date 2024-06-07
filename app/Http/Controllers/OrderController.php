<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create(Request $request)
    {
//        dd('Request Data:', $request->all());
        $validatedData = $request->validate([
            'cartItems' => 'required|array',
            'cartItems.*.id' => 'required|integer',
            'cartItems.*.count' => 'required|integer|min:1',
            'cartItems.*.price' => 'required|numeric|min:0',
            'cartItems.*.name' => 'required|string',
            'cartItems.*.product_type' => 'required|integer',
            'totalPrice' => 'required|numeric|min:0'
        ]);
//        dd('Validated Data:', $validatedData);
        $user = Auth::user();
//        dd($user);
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $validatedData['totalPrice'];
//        dd($orderItem);
        $order->save();

//        dd('Созданный заказ:', $order);

        $cartItems = $request->cartItems;

        foreach ($cartItems as $cartItem) {

//            dd('Элемент корзины:', $cartItem);
            $orderItem = OrderItem::find($cartItem['id']);

//            dd('Найденный заказ:', $orderItem);

            $orderItem->product_type = $cartItem['product_type'];
            $orderItem->count = $cartItem['count'];
            $orderItem->name = $cartItem['name'];
            $orderItem->price = $cartItem['price'];
            $orderItem->order_id = $order->id;
            $orderItem->user_id = $user->id;
//            dd('Элемент корзины:', $orderItem);

            $orderItem->save();
        }
//        dd('Элемент корзины:', $cartItem);

        return response()->json(['message' => 'Order created successfully', 'order_id' => $order->id]);
    }
}
