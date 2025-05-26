@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Users</div>
                <div class="card-body fs-4">{{ $totalUsers }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('admin.users.index') }}">View Users</a>
                    <div class="small text-white"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Total Orders</div>
                <div class="card-body fs-4">{{ $totalOrders }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    {{-- <a class="small text-white stretched-link" href="{{ route('admin.orders.index') }}">View Orders</a> --}}
                    <div class="small text-white"><i class="fas fa-shopping-cart"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Delivered Orders</div>
                <div class="card-body fs-4">{{ $totalOrders }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Details</a>
                    <div class="small text-white"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Today's Sales</div>
                <div class="card-body fs-4">₹{{ number_format($todaysSales, 2) }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Sales Report</a>
                    <div class="small text-white"><i class="fas fa-rupee-sign"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Till Date Sales</div>
                <div class="card-body fs-4">₹{{ number_format($tillDatesale, 2) }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Sales Report</a>
                    <div class="small text-white"><i class="fas fa-rupee-sign"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
