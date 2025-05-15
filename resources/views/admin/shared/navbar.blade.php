<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Addons</div>
                

                <a class="nav-link" href="{{route('category.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Create Category
                </a>
                {{-- <a class="nav-link" href="{{route('product.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Create Fruits
                </a> --}}



                <!-- Fruits Dropdown -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFruits" aria-expanded="false" aria-controls="collapseFruits">
                <div class="sb-nav-link-icon"><i class="fas fa-apple-alt"></i></div>
                 Products
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseFruits" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('product.index') }}">Create Products</a>
                    <a class="nav-link" href="{{ route('fetch.product') }}">List Products</a>
                </nav>
            </div>


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: Admin</div>
        </div>
    </nav>
</div>
