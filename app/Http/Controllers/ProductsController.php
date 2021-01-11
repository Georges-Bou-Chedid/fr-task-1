<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public $total_Price = 0;

    public function ProductsController(int $total_Price)
    {
        $this->total_Price = $total_Price;
    
    }

    public function index(){
        $products = Product::latest()->get();
        return view ('Roles/welcome' , ['products'=>$products]);
    }

    public function show($id){
        $products = Product::find($id);

        return view('Upgrade/show', ['products' => $products]);
    }

    public function create(){
        return view('Upgrade/CreateProduct');
    }

    public function store(Request $request){
        $this->validateProducts($request);

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
        if (Auth()->user()->role == 'Owner'){
            return view ('Roles/Owner', ['products' => auth()->user()->timeline()
            ]);
        }
        else if (Auth()->user()->role == 'Admin'){
            return view ('Roles/Admin', ['products' => auth()->user()->timeline()
            ]);
        }
    }

    public function cart(){
        
        if(Cart::Where('user_id', auth()->id())){
        $carts = Cart::latest()->get();
        $products = Product::all();
        }
        return view('cart' , ['products' => $products],['carts' => $carts]);
    }

    public function addToCart($id){
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        
        $cart = Cart::all();

        if($cart->isEmpty()){
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'Qty'=> 1,
                'Price' => $product->Price,
            ]);
            return redirect('/home')->with('success', 'Product added to cart successfully!');
        }

        
        if(Cart::where('user_id', auth()->id()) && Cart::where('product_id', $product->id)){

                if(DB::table('carts')->pluck('Qty')->first() >= $product->Quantity){
                    return redirect('/home')->with('failure', 'Out Of Stock');
                }
               else{
                DB::table('carts')->increment('Qty');
                $Qty = (DB::table('carts')->pluck('Qty')->first());
                $total_Price = $product->Price * $Qty;
                
                DB::table('carts')->update(['Price' => $total_Price]);

                return redirect('/home')->with('success', 'Product added to cart successfully!');
               }
            }

            else{
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'Qty'=> 1,
                    'Price' => $product->Price,
                ]);
                return redirect('/home')->with('success', 'Product added to cart successfully!');
        }
            }
        

    

    protected function validateProducts(request $request){

        return $request->validate([                       //
            'name' => 'required',                  //                 //
            'Price' => 'required', 
            'Description' => 'required',
            'Quantity' => 'required'                   //
        ]);
        }     

    
}
