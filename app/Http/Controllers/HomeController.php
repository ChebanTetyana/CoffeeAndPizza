<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $menuItems = MenuItem::where('product_type', ProductType::PROMOTION)->get();
        return view('home.index', compact('menuItems'));
    }

    public function about() {
        return view('about.index');
    }
}
