<style>
    /* Prevent the content from hiding behind the fixed navbar */
    body {
        padding-top: 80px; /* Adjust if your navbar is taller */
    }

    .fixed-top {
        z-index: 1030; /* Ensures navbar stays on top */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow */
        background-color: #fff; 
        overflow: hidden;
        position: fixed;
       
    }

</style>


<!-- Navbar start -->
<div class="container-fluid fixed-top">

    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="index.html" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="/" class="nav-item nav-link active">Home</a>
                    {{-- <a href="shop.html" class="nav-item nav-link">Shop</a>
                            <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a> --}}

                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-flex m-3 me-0">


                    <a href="#" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        @php
                            $cartCount = auth()->check()
                                ? \App\Models\Cart::where('user_id', auth()->id())->sum('quantity')
                                : array_sum(session()->get('cart', []));
                        @endphp

                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            {{ $cartCount }}
                        </span>
                     
                    </a>

                    @auth

                        <h3 class="nav-item nav-link">Name : {{ Auth::user()->name }}</h3>
                        {{-- Show logout when logged in --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-secondary" type="submit">Logout</button>
                        </form>
                    @else
                        {{-- Show login and register when not logged in --}}
                        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                    @endauth
                </div>

            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
