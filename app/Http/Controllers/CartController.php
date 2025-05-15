<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function getCartData()
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->get(['product_id', 'quantity']);
        } else {
            $sessionCart = session()->get('cart', []);
            $cart = [];
            foreach ($sessionCart as $productId => $quantity) {
                $cart = [
                    'product_id' => $productId,
                    'quantity' => $quantity
                ];
            }
        }

        return response()->json(['cart' => $cart]);
    }


    public function add(Request $request)
    {


        $productId = $request->product_id;
        $quantity = $request->quantity;

        if (auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
            $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            $cart[$productId]  = ($cart[$productId] ?? 0) +  $quantity;


            session()->put('cart', $cart);
            $cartCount = array_sum($cart);
        }
        return response()->json(['message' => 'Item added', 'cart_count' => $cartCount]);
    }

    public function update(Request $request)
    {
        if (auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();

            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
                if ($cartItem->quantity  < 1) {
                    $cartItem->delete();
                }
            } else {
                return response()->json(['error' => 'Product not found in cart'], 404);
            }

            $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            $cart[$request->product_id] = $request->quantity;
            session()->put('cart', $cart);
            $cartCount = array_sum($cart);
        }
        return response()->json(['message' => 'Cart updated', 'cart_count' => $cartCount]);
    }
    public function showCartPage()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cart = Cart::with('product')->where('user_id', auth()->id())->get();

        return view('customer.cart.cart', compact('cart'));
    }

    public function deleteCartItem(Request $request)
    {

        $Cart_id = $request->cart_id;
        
        $cartItem = Cart::find($Cart_id);
      

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true, 'message' => 'Item Deleted from cart']);
        }
        return response()->json(['success' => false, 'message' => 'Item Not found In cart'], 404);
    }
}
