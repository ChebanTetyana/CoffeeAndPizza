<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Models\MenuItem;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $pizzas = MenuItem::where('product_type', ProductType::PIZZA)
            ->where('size', 'M')
            ->get();
        $coffees = MenuItem::where('product_type', ProductType::COFFEE)
            ->where('size', 'M')
            ->get();
        $promotions = MenuItem::where('product_type', ProductType::PROMOTION)->get();

        return view('menu.index', compact('pizzas', 'coffees', 'promotions'));
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
