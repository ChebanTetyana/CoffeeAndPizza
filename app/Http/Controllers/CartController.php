<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cartItems = OrderItem::all();
        $totalPrice = $cartItems->sum('price');
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function addToCart(Request $request)
    {
//        dd($request->all());
        $validatedData = $request->validate([
            'product_id' => 'required|exists:menu_items,id',
            'size' => 'required',
            'price' => 'required|numeric',
        ]);

        $productId = $validatedData['product_id'];
        $size = $validatedData['size'];
        $price = $validatedData['price'];

        $product = MenuItem::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Продукт не найден'], 404);
        }

        $order_id = null;
        $cartItem = new OrderItem();
        $cartItem->name = $product->name;
        $cartItem->size = $size;
        $cartItem->price = $price;
        $cartItem->image = $product->image;
        $cartItem->product_type = $product->product_type;
        $cartItem->order_id = $order_id;
        $cartItem->count = 1;
//        dd($cartItem);
        $cartItem->save();

        return redirect()->route('cart.index');
    }

    public function getCartItemCount()
    {
        $count = OrderItem::count();
        return response()->json(['count' => $count]);
    }


}
