<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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



        // $key = env('RAZORPAY_KEY_ID');
        // $secret = env('RAZORPAY_KEY_SECRET');

        // // Quick debug to make sure keys are loaded

        // dd(  $key  ,  $secret  );
        // if (!$key || !$secret) {
        //     dd('Razorpay keys not loaded from .env');
        // }

        // $api = new Api($key, $secret);
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        
        $payment_id = $request->razorpay_payment_id;

        try {

         
            $payment = $api->payment->fetch($payment_id);
          

            if ($payment->status == 'captured'  ||  $payment->status == 'authorized') {
                $order = new Order();
                $order->user_id =  auth()->id();
                $order->total_amount =  $payment->amount / 100;
                $order->payment_id =  $request->razorpay_payment_id;
                $order->status =  'paid';
                $order->save();


                foreach (Cart::where('user_id', auth()->id())->get() as $item) {

                    $order->orderItems()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->discount_price,
                    ]);
                }

                Cart::where('user_id', auth()->id())->delete();

                // Mail::to(auth()->user()->email)->send(new OrderPlacedMail($order));


                return redirect()->route('order.success', $order->id);
            } else {
                return redirect()->back()->with('error', 'Payment not captured.');
            }
        } catch (\Exception $e) {
            dd("2", 'Razorpay Payment Error: ' . $e->getMessage());
            \Log::error('Razorpay Payment Error: ' . $e->getMessage());
            Session::put('error', 'Payment failed. Please try again.');
        }

        return redirect()->back();
    }
}
