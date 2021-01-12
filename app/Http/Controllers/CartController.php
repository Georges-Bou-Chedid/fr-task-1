<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(){
        if(Cart::Where('user_id',auth()->id())->first()){
        $carts = Cart::Where('user_id',auth()->id())->sharedLock()->get();
        return view('cart' ,['carts' => $carts]);
        }
        else{
            return redirect('/home')->with('cartempty', 'Please Fill Up Your Cart!!!');
        }
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

        
        if(Cart::where('user_id', auth()->id())->first() && Cart::where('product_id', $product->id)->first()){

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
}
