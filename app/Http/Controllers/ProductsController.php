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
        
        if(auth()->user() && auth()->user()->role == User::OWNER){
        return view('Roles/Owner' , ['products'=>auth()->user()->timeline()]);
        }

        $products = Product::latest()->get();

        if(!auth()->user()){
            return view ('Roles/welcome', ['products'=>$products]);
        }

        if(auth()->user()->role == User::MEMBER){
            return view('Roles/Member', ['products'=>$products]);
             }
        return view('Roles/Admin', ['products'=>$products]);
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

        return redirect('/');
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

        return redirect('/'. $products->id);
    }

    public function delete($id){
        $products = Product::find($id);
        $products->delete();

        return redirect('/');
    }

    public function fetch(){
            return view ('Roles/Admin', ['products' => auth()->user()->timeline()]);
    }    
}

