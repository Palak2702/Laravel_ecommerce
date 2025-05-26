@extends('customer.layouts.app')

@section('title', 'My Orders')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">🧾 My Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            You haven't placed any orders yet.
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover m-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Order #</th>
                                <th>Items</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Placed On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number ?? '-' }}</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($order->orderItems as $item)
                                                <li>📦 {{ $item->product->name ?? 'Product' }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($order->orderItems as $item)
                                                <li>🧮 {{ $item['quantity'] }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection
