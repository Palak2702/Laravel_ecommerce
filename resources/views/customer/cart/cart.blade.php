@extends('customer.layouts.app')

@section('title', 'Home')


@section('content')



    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            {{-- <th scope="col">Quantity</th> --}}
                            <th scope="col">Total</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">After Discount Price</th>
                            <th scope="col">Empty Cart</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cart as $item => $value)
                            <tr>


                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="/storage/{{ $value->product->image }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $value->product->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $value->product->price_per_kg_inr }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $value->product->discount }}{{ $value->product->discount_type }}
                                    </p>
                                </td>
                                {{-- <td>
                                    <p class="mb-0 mt-4">{{ $value->quantity }}</p>
                                </td> --}}
                                <td>

                                    <div class="quantity-controls mt-2" data-product-id="{{ $value->product->id }}">
                                        <button class="btn btn-sm btn-outline-secondary update-qty-decrease"
                                            data-product-id="{{ $value->product->id }}">-</button>
                                        <input type="text" class="qty-input mx-1 text-center border-0 cart-qty-input"
                                            data-product-id="{{ $value->product->id }}" value="{{ $value->quantity }}"
                                            readonly style="width: 40px;">
                                        <button class="btn btn-sm btn-outline-secondary update-qty-increase"
                                            data-product-id="{{ $value->product->id }}">+</button>
                                    </div>

                                </td>


                                <td>
                                    <p class="mb-0 mt-4" id="original-price-{{ $value->product->id }}">
                                        ₹{{ $value->original_price }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="discount-price-{{ $value->product->id }}">
                                        ₹{{ $value->discount_price }}</p>
                                </td>


                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 delete-cart-item"
                                        data-cart-id="{{ $value->id }}">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            {{-- <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply
                    Coupon</button>
            </div> --}}
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="cart-total">--</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">100 Rs</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end">Shipping to .</p>
                        </div>
                        <div
                            class="py-4 mb-4 border-top border-bottom d-flex justify-content-between align-items-center px-4">
                            <h5 class="mb-0">Total</h5>
                            <p class="mb-0" id="final-cart-total">--</p>
                        </div>
                        <button id="pay-button"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                            Proceed to Pay
                        </button>



                        {{-- <form action="{{ route('razorpay.payment.store') }}" method="POST">

                            @csrf

                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY_ID') }}"
                                data-amount="{{ (int)(($finalTotalAmount ?? 100) * 100) }}" data-currency="INR" data-buttontext="Proceed Checkout"
                                data-name="ShopSphere" data-description="Order Payment"
                                data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                data-prefill.name="{{ auth()->user()->name ?? 'Guest' }}"
                                data-prefill.email="{{ auth()->user()->email ?? 'guest@example.com' }}" data-theme.color="#ff7529"></script>

                        </form> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            refreshCartTotal();
            let finalAmount = 0;

            function refreshCartTotal() {
                $.ajax({
                    url: "{{ route('cart.subtotal') }}",
                    method: 'GET',
                    success: function(response) {
                        $('#cart-total').text(response.before_total_amount);
                        $('#final-cart-total').text(response.final_total_amount);
                        finalAmount = response.final_total_amount * 100; // SEND IN pAISA
                    },
                    error: function() {
                        console.error("Failed to fetch cart subtotal.");
                    }
                });
            }



            document.getElementById('pay-button').addEventListener('click', function(e) {
                e.preventDefault();

                let options = {
                    "key": "{{ env('RAZORPAY_KEY_ID') }}",
                    "amount": finalAmount,
                    "currency": "INR",
                    "name": "ShopSphere",
                    "description": "Order Payment",
                    "image": "https://www.itsolutionstuff.com/frontTheme/images/logo.png",
                    "handler": function(response) {
                        // Send response.razorpay_payment_id to server
                        let form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('razorpay.payment.store') }}";

                        let token = document.createElement('input');
                        token.type = 'hidden';
                        token.name = '_token';
                        token.value = '{{ csrf_token() }}';
                        form.appendChild(token);

                        let paymentId = document.createElement('input');
                        paymentId.type = 'hidden';
                        paymentId.name = 'razorpay_payment_id';
                        paymentId.value = response.razorpay_payment_id;
                        form.appendChild(paymentId);

                        document.body.appendChild(form);
                        form.submit();
                    },
                    "prefill": {
                        "name": "{{ auth()->user()->name ?? 'Guest' }}",
                        "email": "{{ auth()->user()->email ?? 'guest@example.com' }}",
                        "contact": "8696259964"
                    },
                    "theme": {
                        "color": "#ff7529"
                    }
                };

                let rzp = new Razorpay(options);
                rzp.open();
            });

            $(document).on('click', '.delete-cart-item', function() {

                let cartId = $(this).data('cart-id');
                let row = $(this).closest('tr');

                $.ajax({

                    url: '{{ route('cart.delete.item') }}',
                    method: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cart_id: cartId,
                    },

                    success: function(response) {
                        if (response.success) {
                            row.remove();
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }

                    },
                    error: function() {
                        alert('Error removing item.');
                    }

                });

            });


            $(document).on('click', '.update-qty-increase', function() {

                const productId = $(this).data('product-id');
                const input = $(this).siblings('.cart-qty-input');
                let quantity = parseInt(input.val()) + 1;

                input.val(quantity);

                console.log(productId, quantity);

                updateCart(productId, quantity);
            });

            $(document).on('click', '.update-qty-decrease', function() {

                const productId = $(this).data('product-id');
                const input = $(this).siblings('.cart-qty-input');
                let quantity = parseInt(input.val()) - 1;

                if (quantity < 1) {
                    quantity = 0;
                    input.val(quantity);
                    // updateCart(productId, quantity);
                    $(this).closest('tr').fadeOut(300, function() {
                        $(this).remove();
                    });


                }
                input.val(quantity);
                updateCart(productId, quantity);


            });

            function updateCart(productId, quantity) {

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        const originalPrice = response.original_price;
                        const discountPrice = response.discount_price;
                        updateCartCount(response.cart_count);
                        refreshCartTotal()
                        $(`#original-price-${productId}`).text(originalPrice.toFixed(2));
                        $(`#discount-price-${productId}`).text(discountPrice.toFixed(2));
                    },
                    error: function(xhr) {
                        alert("Failed to update cart.");
                    }

                });

            }

            function updateCartCount(count) {
                $('.fa-shopping-bag').siblings('span').text(count);
            }



        });
    </script>



@endsection
