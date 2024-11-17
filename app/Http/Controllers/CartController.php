<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();

        return view('pages.cart', [
            'carts' => $carts
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        
        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
