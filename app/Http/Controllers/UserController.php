<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function getorders()
    {


        $user_id = Auth::user()->id;
        $orders = Order::with('orderItems')->where('user_id', $user_id)->get();

        return view('customer.order.orderlist', compact('orders'));
    }


    public function show()
    {
        return view('customer.contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Send email (optional)
        // Mail::to('your@email.com')->send(new ContactMessageMail($request->all()));

        return redirect()->route('contact.show')->with('success', 'Your message has been sent!');
    }


    public function list_users()
    {

        $data = User::get();
        return view('admin.users.list', compact('data'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->active_status = !$user->active_status;
        $user->save();

        return redirect()->back()->with('success', 'User status updated!');
    }

    public function updateRole(Request $request, $id)
    {


        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User role updated!');
    }
}
