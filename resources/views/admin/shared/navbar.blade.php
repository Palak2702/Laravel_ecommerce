<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Management</div>

                <a class="nav-link" href="{{ route('category.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-plus"></i></div>
                    Manage Categories
                </a>

                <!-- Products Dropdown -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts"
                   aria-expanded="false" aria-controls="collapseProducts">
                    <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseProducts" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('product.index') }}">Create Product</a>
                        <a class="nav-link" href="{{ route('fetch.product') }}">List Products</a>
                    </nav>
                </div>

                <!-- Users Dropdown -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers"
                   aria-expanded="false" aria-controls="collapseUsers">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseUsers" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">List Users</a>
                    </nav>
                </div>

                <!-- Orders Link -->
                {{-- <a class="nav-link" href="{{ route('admin.orders.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Manage Orders
                </a> --}}

                <div class="sb-sidenav-menu-heading">Others</div>

                {{-- <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                    Contact Messages
                </a> --}}

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Admin
        </div>
    </nav>
</div>
