<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect('/products');
        return view('home');
    }

    public function userView(): Renderable
    {
        if (auth()->user()->type == 'customer') {
            return view('products');
        }
        return view('dashboard');
    }
}
