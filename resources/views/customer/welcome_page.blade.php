@extends('customer.layouts.app')

@section('title', 'Home')


@section('content')

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">

            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                    <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number"
                            placeholder="Search">
                        <button type="submit"
                            class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                            style="top: 0; right: 25%;">Submit Now</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="{{ asset('assets/customer/img/hero-img-1.png') }}"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="{{ asset('assets/customer/img/hero-img-2.jpg') }}"
                                    class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Free Shipping</h5>
                            <p class="mb-0">Free on order over $300</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Security Payment</h5>
                            <p class="mb-0">100% security payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>30 Day Return</h5>
                            <p class="mb-0">30 day money guarantee</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>24/7 Support</h5>
                            <p class="mb-0">Support every time fast</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->
    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Our Organic Products</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill category-tab {{ $loop->first ? 'active' : '' }} "
                                        data-category-id="{{ $category->id }}" href="javascript:void(0);">
                                        <span class="text-dark" style="width: 130px;">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div id="product-list" class="row g-4">
                                        {{-- Products will be loaded here via AJAX --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let cartData = [];

            const firstCategoryId = $('.category-tab').first().data('category-id');
            let isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

            loadCartData().then(() => {
                loadProducts(firstCategoryId);
            });

            $('.category-tab').click(function() {
                $('.category-tab').removeClass('active');
                $(this).addClass('active');

                const categoryId = $(this).data('category-id');
                loadProducts(categoryId);
            });

            function loadCartData() {
                return $.ajax({
                    url: '{{ route('cart.get.data') }}',
                    method: 'GET',
                }).then(function(response){
                    let cart = response.cart || [];
                    if (!Array.isArray(cart)) {
                        cart = Object.values(cart); 
                    }
                    cartData = cart;
                    return cartData;
                });
              
            }

            function loadProducts(categoryId) {
                $.ajax({
                    url: `/products-by-category/${categoryId}`,
                    type: 'GET',
                    success: function(products) {
                        let html = '';

                        if (products.length > 0) {
                            products.forEach(product => {
                                const cartItem = cartData.find(item => item.product_id ==
                                    product.id);
                                const quantity = cartItem ? cartItem.quantity : 0;

                                html +=
                                    `
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="/storage/${product.image}" class="img-fluid w-100 rounded-top" alt="Product Image">
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>${product.name}</h4>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">${product.price_per_kg_inr} / kg</p>
                                            <p class="text-dark fs-5 fw-bold mb-0">-${product.discount} ${product.discount_type}</p>`;

                                if (quantity > 0 ) {
                                    html += `
                                    <a href="javascript:void(0);" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart d-none" data-product-id="${product.id}">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                    </a>
                                    <div class="quantity-controls mt-2" data-product-id="${product.id}">
                                        <button class="btn btn-sm btn-outline-secondary decrease-qty" data-product-id="${product.id}">-</button>
                                        <input type="text" class="qty-input mx-1 text-center" value="${quantity}" readonly style="width: 40px;">
                                        <button class="btn btn-sm btn-outline-secondary increase-qty" data-product-id="${product.id}">+</button>
                                    </div>`;
                                } else {
                                    html += `
                                    <a href="javascript:void(0);" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-product-id="${product.id}">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                    </a>
                                    <div class="quantity-controls d-none mt-2" data-product-id="${product.id}">
                                        <button class="btn btn-sm btn-outline-secondary decrease-qty" data-product-id="${product.id}">-</button>
                                        <input type="text" class="qty-input mx-1 text-center" value="1" readonly style="width: 40px;">
                                        <button class="btn btn-sm btn-outline-secondary increase-qty" data-product-id="${product.id}">+</button>
                                    </div>`;
                                }

                                html += `</div></div></div></div>`;
                            });
                        } else {
                            html = `<p>No products found in this category.</p>`;
                        }

                        $('#product-list').html(html);
                    },
                    error: function() {
                        alert('Failed to fetch products.');
                    }
                });
            }

            $(document).on('click', '.add-to-cart', function(){
                const productId = $(this).data('product-id');
                const btn = $(this);
                const qty = 1;

                $.ajax({
                    url: '/add-to-cart',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: qty,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        btn.hide();
                        const qtyControl = $(
                            `.quantity-controls[data-product-id="${productId}"]`);
                        qtyControl.removeClass('d-none');
                        qtyControl.find('.qty-input').val(1); // reset to 1 when added
                        updateCartCount(response.cart_count);
                    },
                    error: function() {
                        alert('Error adding to cart');
                    }
                });
            });

            $(document).on('click', '.increase-qty', function() {
                const productId = $(this).data('product-id');
                const input = $(this).siblings('.qty-input');
                let quantity = parseInt(input.val()) + 1;
                updateCart(productId, input, quantity);
            });

            $(document).on('click', '.decrease-qty', function() {
                const productId = $(this).data('product-id');
                const input = $(this).siblings('.qty-input');
                let quantity = parseInt(input.val()) - 1;

                if (quantity < 1) {
                    quantity = 0;
                    input.val(quantity);
                    // input.val(0);
                    $(`.quantity-controls[data-product-id="${productId}"]`).addClass('d-none');
                    $(`.add-to-cart[data-product-id="${productId}"]`).show();
                    $(`.add-to-cart[data-product-id="${productId}"]`).removeClass('d-none');
                }

                updateCart(productId, input, quantity);
            });

            function updateCart(productId, input, quantity) {
                $.ajax({
                    url: '/update-cart',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        updateCartCount(response.cart_count);

                        if (quantity < 1) {
                            // Hide +/-
                            $(`.quantity-controls[data-product-id="${productId}"]`).addClass('d-none');
                            // Show "Add to Cart"
                            $(`.add-to-cart[data-product-id="${productId}"]`).show();
                             $(`.add-to-cart[data-product-id="${productId}"]`).removeClass('d-none');
                        } else {
                            input.val(quantity);
                        }
                    },
                    error: function() {
                        alert('Failed to update cart.');
                    }
                });
            }


            function updateCartCount(count) {
                $('.fa-shopping-bag').siblings('span').text(count);
            }

            $('.fa-shopping-bag').parent().click(function(e) {
                e.preventDefault();
                if (isLoggedIn) {
                    window.location.href = "{{ route('cart.showCart') }}";
                } else {
                    window.location.href = "{{ route('login') }}";
                }
            });
        });
    </script>




@endsection
