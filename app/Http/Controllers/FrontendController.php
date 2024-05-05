<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index ()
    {
        $categories = Category::all();
        $products = Product::all();
        return view ('layouts.frontend.index', compact('categories', 'products'));
    }
    

}
