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
        $validatedData = $request->validate([
            'cartItems' => 'required|array',
            'cartItems.*.id' => 'required|integer',
            'cartItems.*.count' => 'required|integer|min:1',
            'cartItems.*.price' => 'required|numeric|min:0',
            'cartItems.*.name' => 'required|string',
            'cartItems.*.product_type' => 'required|integer',
            'totalPrice' => 'required|numeric|min:0'
        ]);

        $user = Auth::user();
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $validatedData['totalPrice'];

        $order->save();

        $cartItems = $request->cartItems;

        foreach ($cartItems as $cartItem) {

            $orderItem = OrderItem::find($cartItem['id']);

            $orderItem->product_type = $cartItem['product_type'];
            $orderItem->count = $cartItem['count'];
            $orderItem->name = $cartItem['name'];
            $orderItem->price = $cartItem['price'];
            $orderItem->order_id = $order->id;
            $orderItem->user_id = $user->id;

            $orderItem->save();
        }

        return response()->json(['message' => 'Order created successfully', 'order_id' => $order->id]);
    }
}
