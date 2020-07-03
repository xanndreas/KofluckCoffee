<?php

namespace App\Http\Controllers\Admin;

use Auth;

class HomeController
{
    public function index()
    {
        if (!Auth::user()->getIsAdminAttribute()) { // do your magic here
            return redirect()->route('home');
        }

        return view('admin.home');
    }
}