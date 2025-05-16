<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;


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
            $cartItem = Cart::with('product')->where('user_id', auth()->id())->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $priceInfo = calculatePrice($productId, $quantity);
                $cartItem->original_price = $priceInfo['original_price'];
                $cartItem->discount_price = $priceInfo['discount_price'];
                $cartItem->save();
            } else {
                $priceInfo = calculatePrice($productId, $quantity);
                $cartItem = new Cart();
                $cartItem->user_id = auth()->id();
                $cartItem->product_id = $productId;
                $cartItem->quantity = $quantity;
                $cartItem->original_price = $priceInfo['original_price'];
                $cartItem->discount_price = $priceInfo['discount_price'];
                $cartItem->save();
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
            $cartItem = Cart::with('product')->where('user_id', auth()->id())->where('product_id', $request->product_id)->first();

            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $priceInfo = calculatePrice($request->product_id, $request->quantity);
                $cartItem->original_price = $priceInfo['original_price'];
                $cartItem->discount_price = $priceInfo['discount_price'];
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
        return response()->json([
            'message' => 'Cart updated',
            'cart_count' => $cartCount,
            'original_price' => $cartItem->original_price,
            'discount_price' => $cartItem->discount_price,
        ]);
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

    public function getCartSubtotal()
    {

        $cartItem = Cart::where('user_id', auth()->id())->get();
        $before_total_amount = Cart::where('user_id', auth()->id())->sum('discount_price');

        $shipping_charges = 100;

        $end_total_amount  = $before_total_amount + 100;
        return response()->json([
            'message' => 'Cart updated',
            'before_total_amount' => $before_total_amount,
            'final_total_amount' => $end_total_amount
        ]);
    }


    public function razonPayStore(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
        ]);

        try {
           

            // $api = new Api($RAZORPAY_KEY_ID, $RAZORPAY_KEY_SECRET);
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            $payment = $api->payment->fetch($request->razorpay_payment_id);

            $response = $payment->capture(['amount' => $payment['amount']]);

            // You can optionally store in DB here

            Session::put('success', 'Payment successful');
        } catch (\Exception $e) {
            \Log::error('Razorpay Payment Error: ' . $e->getMessage());
            Session::put('error', 'Payment failed. Please try again.');
        }

        return redirect()->back();
    }

   
}
