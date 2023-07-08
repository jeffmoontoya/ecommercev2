<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('cart.cart', ['cart' => $cart]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $quantity = $request->quantity;
        $totalPrice = $product->product_price * $quantity;

        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = Auth::user()->id; // Asigna el ID del usuario actual
        $cart->quantity = $quantity;
        $cart->total_price = $totalPrice;
        $cart->save();
        return redirect()->route('cart.show');
    }

    public function getUserCart()
    {
        $cart = Cart::where('user_id', auth()->user()->id)
            ->with('product.category')
            ->get();
        return response()->json(['userCart' => $cart]);
    }

    public function getCart(Cart $cart){
        return response()->json(['cart' => $cart]);
    }

    public function deleteCart(Cart $cart)
    {
        $cart->delete();
    }
}
