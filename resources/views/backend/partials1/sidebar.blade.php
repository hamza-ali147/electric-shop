<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('../assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    @can('view permissions')
                        <a class="nav-link" href="{{ route('permissions.index') }}">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Permissions</span>
                        </a>
                    @endcan

                </li>
                <li class="nav-small-cap">
                    @can('view roles')
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Roles</span>
                        </a>
                    @endcan

                </li>
                <li class="nav-small-cap">
                    @can('view users')
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    @endcan

                </li>
                <li class="nav-small-cap">
                    @can('view articles')
                        <a class="nav-link" href="{{ route('articles.index') }}">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Articles</span>
                        </a>
                    @endcan

                </li>
                <li class="nav-small-cap">
                    @can('view products')
                        <a class="nav-link" href="{{ route('products.index') }}">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Products</span>
                        </a>
                    @endcan

                </li>

                <li class="nav-small-cap">
                    @can('view categories')
                    <a class="nav-link" href="{{ route('categories.index') }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Category</span>
                    </a>  
                    @endcan
                
                </li>

                <li class="nav-small-cap">
                    @can('view brands')
                    <a class="nav-link" href="{{ route('brands.index') }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Brands</span>
                    </a>  
                    @endcan
                    
                </li>
                <li class="nav-small-cap">
                    @can('view filters')
                    <a class="nav-link" href="{{ route('filter.index') }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Product-Filter</span>
                    </a>
                    @endcan
                
                </li>
                <li class="nav-small-cap">
                    @can('view carts')
                    <a class="nav-link" href="{{route('cart.index')  }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Cart items</span>
                    </a>  
                    @endcan
                    
                </li>
                <li class="nav-small-cap">
                    @can('view checkouts')
                    <a class="nav-link" href="{{route('checkout.index')  }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Checkout</span>
                    </a>  
                    @endcan
                    
                </li>
                <li class="nav-small-cap">
                    @can('view orders')
                    <a class="nav-link" href="{{route('orders.index')  }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Orders</span>
                    </a>  
                    @endcan
                    
                </li>
                <li class="nav-small-cap">
                    @can('view order_items')
                    <a class="nav-link" href="{{route('order-items.index')  }}">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Orders-items</span>
                    </a>  
                    @endcan
                    
                </li>
            

            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
