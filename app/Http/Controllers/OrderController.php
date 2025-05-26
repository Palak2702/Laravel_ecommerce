<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success(Order $order)
    {
        
        return view('customer.order.success', compact('order'));
    }
}
