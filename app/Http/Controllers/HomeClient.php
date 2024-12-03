<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeClient extends Controller
{
    public function index(){
        $laptops= Product::with('category')->where('categoryId',1)->get();
        $cameras= Product::with('category')->where('categoryId',2)->get();
        $accessories = Product::with('category')->where('categoryId',3)->get();
        return view('users.pages.home',compact('laptops','cameras','accessories'));
    }
}
