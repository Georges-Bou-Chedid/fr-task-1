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
  
        $products = Cart::where('user_id', auth()->id())->get();

        if($products->isEmpty()){
            return redirect('/')->with('cartempty', 'Please Fill Up Your Cart!!!');
        }

        return view('cart' ,['carts' => $products]);

    }

    public function addToCart($id){
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        
        $cart = Cart::where('user_id', auth()->id())->get();

        if($cart->isEmpty()){
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'Qty'=> 1,
                'Price' => $product->Price,
            ]);
            return redirect('/')->with('success', 'Product added to cart successfully!');
        }

        
        if($userproduct = $cart->where('product_id' , $id)->first()){

                
                if($userproduct->Qty >= $product->Quantity){
                    return redirect('/')->with('failure', 'Out Of Stock');
                }
               else{
                $newquantity = $userproduct->Qty + 1;

                $userproduct->update([
                    'Qty' => $newquantity,
                    'Price' => $product->Price * $newquantity
                ]);

                return redirect('/')->with('success', 'Product added to cart successfully!');
               }
            }

            else{
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'Qty'=> 1,
                    'Price' => $product->Price,
                ]);
                return redirect('/')->with('success', 'Product added to cart successfully!');
        }
            }
}
