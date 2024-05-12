<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        return view('menu.index');
    }

    public function getPizzas()
    {
        $menuItems = MenuItem::where('product_type', ProductType::PIZZA)
            ->where('size', 'M')
            ->get();
        return view('pizza.index', compact( 'menuItems'));
    }

    public function getCoffee()
    {
        $menuItems = MenuItem::where('product_type', ProductType::COFFEE)
            ->where('size', 'M')
            ->get();
        return view('coffee.index', compact( 'menuItems'));
    }

    public function getPrice(Request $request)
    {
        $size = $request->input('size');
        $pizza = MenuItem::where('product_type', ProductType::PIZZA)
            ->where('size', $size)
            ->first();

        return response()->json(['price' => $pizza->price]);
    }
}
