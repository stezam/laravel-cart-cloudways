<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        // var_dump(session('cartItems'));
        return view('cart.cart');
    }

    public function addToCart($id){
        $product = Product::findOrFail($id);
        $cartItems = session()->get('cartItems',[]);
        if(isset($cartItems[$id])){
            $cartItems[$id]['quantity']++;
        }else{
            $cartItems[$id] = [
                "img_path" => $product->img_path,
                'name' => $product->name,
                'brand' =>$product->brand,
                'details' =>  $product->details,
                'price' => "$product->price",
                'quantity' => 1
             ];
        }
        session()->put('cartItems', $cartItems);
        return redirect()->back()->with('success','Product added to cart!');
    }
}
