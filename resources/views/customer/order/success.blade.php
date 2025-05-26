@extends('customer.layouts.app')

@section('title', 'Order Success')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg rounded-4">
                <div class="card-body text-center p-5">

                    <h2 class="text-success mb-4">
                        <i class="fas fa-check-circle"></i> Thank You for Your Order!
                    </h2>

                    <p class="fs-5 mb-3">Your order has been placed successfully.</p>

                    <hr>

                    <div class="text-start mt-4">
                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Amount Paid:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-success text-uppercase">{{ $order->status }}</span>
                        </p>
                    </div>

                    {{-- <a href="{{ route('user.orders') }}" class="btn btn-primary mt-4">
                        View My Orders
                    </a> --}}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
