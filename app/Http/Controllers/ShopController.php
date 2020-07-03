<?php

namespace App\Http\Controllers;

class ShopController extends Controller
{

    public function index()
    {
        return view('users.shop.index');
    }
}