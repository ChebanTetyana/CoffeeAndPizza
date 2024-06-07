<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $menuItems = MenuItem::where('product_type', ProductType::PROMOTION)->get();
        return view('promotion.index', compact('menuItems'));
    }

    public function about() {
        if (auth()->check()) {
            return view('about.index', ['user' => auth()->user()]);
        } else {
            return view('about.index');
        }
    }
}
