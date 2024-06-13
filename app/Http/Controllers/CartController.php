<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {

        $user = Auth::user();
        $cartItems = OrderItem::whereNull('order_id')->where('user_id', $user->id)->get();

        $totalPrice = $cartItems->sum(function($item) {
            return $item->price * $item->count;
        });
        $totalPricePerItems = $cartItems->keyBy('id')->map(function ($item) {
            return $item->price * $item->count;
        });

        return view('cart.index', compact('cartItems', 'totalPrice', 'totalPricePerItems'));
    }

    public function delete($id)
    {
        $product = OrderItem::findOrFail($id);
        $product->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'product_id' => 'required|exists:menu_items,id',
            'size' => 'nullable',
            'price' => 'required|numeric',
        ]);


        $productId = $validatedData['product_id'];
        $size = $validatedData['size'];
        $price = $validatedData['price'];
        $product = MenuItem::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $order_id = null;
        $cartItem = new OrderItem();
        $cartItem->name = $product->name;
        $cartItem->size = $product->product_type === 'promotion' ? null : $size;
        $cartItem->price = $product->product_type === 'promotion' ? 6.00 : $price;
        $cartItem->image = $product->image;
        $cartItem->product_type = $product->product_type;
        $cartItem->order_id = $order_id;
        $cartItem->count = 1;
        $cartItem->user_id = $user->id;

        $cartItem->save();

        return redirect()->route('cart.index');
    }

    public function getCartItemCount()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $count = OrderItem::whereNull('order_id')->where('user_id', $user->id)->count();

        return response()->json(['count' => $count]);
    }

}
