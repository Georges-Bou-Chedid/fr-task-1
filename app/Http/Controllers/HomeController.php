<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::latest()->get();

        if(auth()->user()->role == 'Member'){
       return view('Roles/welcome', ['products'=>$products]);
        }
       else if(auth()->user()->role == 'Admin'){
           return view('Roles/Admin', ['products'=>$products]);
       }
       else if(auth()->user()->role == 'Owner'){
           return view('Roles/Owner' , ['products'=>$products]);
       }

    }

}
