<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showregisterForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->save();

        Auth::login($user);

        if ($user->role === 1) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/customer/dashboard');
        }
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 1) {

                return redirect('/admin/dashboard');
            } elseif ($user->role == 2) {

                $sessionCart = session()->get('cart', []);

                foreach ($sessionCart as $productId => $quantity) {
                    $cart = Cart::firstOrNew([
                        'user_id' => $user->id,
                        'product_id' => $productId
                    ]);
                    $cart->quantity += $quantity;
                    $cart->save();
                }

                session()->forget('cart');

                return redirect('/');
            }
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
