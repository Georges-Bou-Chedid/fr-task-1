<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\storeproductrequest;

class ProductsController extends Controller
{
    /*
    * @return void
    */
    public function index(){
        $products = Product::latest()->get();

        if(auth()->user()){
        if(auth()->user()->role == 'Member'){
            return view('Roles/Member', ['products'=>$products]);
             }
            else if(auth()->user()->role == 'Admin'){
                return view('Roles/Admin', ['products'=>$products]);
            }
            else if(auth()->user()->role == 'Owner'){
                return view('Roles/Owner' , ['products'=>auth()->user()->timeline()]);
            }
        }
            else {
            return view ('Roles/welcome', ['products'=>$products]);
            }
    }

    public function show($id){
        $products = Product::find($id);

        return view('Upgrade/show', ['products' => $products]);
    }

    public function create(){
        return view('Upgrade/CreateProduct');
    }

    public function store(storeproductrequest $request){
       $validated = $request->validated();

        $products = new Product();

        $products->user_id = auth()->user()->id;
        $products->name = request('name');
        $products->img = request('img');
        $products->Price = request('Price');
        $products->Description = request('Description');
        $products->Quantity = request('Quantity');
       
        $products->save();

        return redirect('/home');
    }

    public function edit($id){
        $products = Product::find($id);
        return view ('Upgrade/edit', ['products' => $products]);
    }

    public function update($id){
        $products = Product::find($id);
        
        $products->name = request('name');
        $products->img = request('img');
        $products->Price = request('Price');
        $products->Description = request('Description');
        $products->Quantity = request('Quantity');
        $products->save();

        return redirect('/home/' . $products->id);
    }

    public function delete($id){
        $products = Product::find($id);
        $products->delete();

        return redirect('/home');
    }

    public function fetch(){
        if (Auth()->user()->role == 'Admin'){
            return view ('Roles/Admin', ['products' => auth()->user()->timeline()
            ]);
        }
    }    
}

