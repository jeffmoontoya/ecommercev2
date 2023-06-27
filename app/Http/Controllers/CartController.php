<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('cart.cart', ['cart' => $cart]);
    }

    // public function getCart()
    // {
    //     $cart = Cart::where('user_id', auth()->user()->id)->get();
    //     return response()->json($cart);
    // }

    // public function clearCart()
    // {
    //     Cart::where('user_id', auth()->user()->id)->delete();
    //     return response()->json(['message' => 'Carrito limpiado con éxito']);
    // }

    // public function addProductToCart(Request $request)
    // {
    //     // Validar los datos del producto a agregar al carrito
    //     $request->validate([
    //         'product_id' => 'required',
    //         'quantity' => 'required|integer|min:1'
    //     ]);

        // // Crear un nuevo registro en la tabla "carts" para el usuario logueado
        // Cart::create([
        //     'user_id' => auth()->user()->id,
        //     'product_id' => $request->input('product_id'),
    //     //     'quantity' => $request->input('quantity')
    //     // ]);

    //     return response()->json(['message' => 'Producto agregado al carrito con éxito']);
    // }

    // public function removeProductFromCart(Request $request)
    // {
    //     // Validar los datos del producto a eliminar del carrito
    //     $request->validate([
    //         'cart_id' => 'required'
    //     ]);

    //     // Eliminar el registro correspondiente del carrito para el usuario logueado
    //     Cart::where('user_id', auth()->user()->id)
    //         ->where('id', $request->input('cart_id'))
    //         ->delete();

    //     return response()->json(['message' => 'Producto eliminado del carrito con éxito']);
    // }

    // public function updateProductFromCart(Request $request)
    // {
    //     // Validar los datos del producto a actualizar en el carrito
    //     $request->validate([
    //         'cart_id' => 'required',
    //         'quantity' => 'required|integer|min:1'
    //     ]);

    //     // Actualizar la cantidad del producto en el carrito para el usuario logueado
    //     Cart::where('user_id', auth()->user()->id)
    //         ->where('id', $request->input('cart_id'))
    //         ->update(['quantity' => $request->input('quantity')]);

    //     return response()->json(['message' => 'Producto actualizado en el carrito con éxito']);
    // }
}
