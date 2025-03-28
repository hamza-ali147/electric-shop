@extends('backend.layout.master')
@section('body')
    <div class="container mt-5">

        <!-- Stats Cards -->
        <div class="row mb-4">
            <!-- Product Count -->
            <div class="col-md-3">
                <a href="{{ route('products.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="icon-container me-3">
                            <i class="fas fa-box fa-3x"></i>
                        </div>
                        <div>
                            <h4>Total Products</h4>
                            <p class="h5">{{ $productCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Category Count -->
            <div class="col-md-3">
                <a href="{{ route('categories.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="icon-container me-3">
                            <i class="fas fa-tags fa-3x"></i>
                        </div>
                        <div>
                            <h4>Total Categories</h4>
                            <p class="h5">{{ $categoryCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Brand Count -->
            <div class="col-md-3">
                <a href="{{ route('brands.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="icon-container me-3">
                            <i class="fas fa-clipboard-list fa-3x"></i>
                        </div>
                        <div>
                            <h4>Total Brands</h4>
                            <p class="h5">{{ $brandCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Order Count - Clickable card to open orders page -->
            <div class="col-md-3">
                <a href="{{ route('orders.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="icon-container me-3">
                            <i class="fas fa-shopping-cart fa-3x"></i>
                        </div>
                        <div>
                            <h4>Total Orders</h4>
                            <p class="h5">{{ $orderCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- New Stats Cards -->
        <div class="row mb-4">
            <!-- User Count -->
            <div class="col-md-3">
                <a href="{{ route('users.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="icon-container me-3">
                            <i class="fas fa-user fa-3x"></i>
                        </div>
                        <div>
                            <h4>Total Users</h4>
                            <p class="h5">{{ $userCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Ordered Items Count -->
            <div class="col-md-3">
                <a href="{{ route('order-items.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="card d-flex flex-row align-items-center p-3">
                        <div class="icon-container me-3">
                            <i class="fas fa-boxes fa-3x"></i>
                        </div>
                        <div>
                            <h4>Ordered Items</h4>
                            <p class="h5">{{ $orderedItemCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Circle Graphs (Charts) -->
        <div class="row">
            <!-- Products by Category Chart -->
            <div class="col-md-6">
                <h4 class="mb-3">Products by Category</h4>
                <div class="chart-container" style="position: relative; height:40vh; width:100%">
                    <canvas id="productChart"></canvas>
                </div>
            </div>
            <!-- Brands Overview Chart -->
            <div class="col-md-6">
                <h4 class="mb-3">Brands Overview</h4>
                <div class="chart-container" style="position: relative; height:40vh; width:100%">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Card styles */
        .card {
            transition: all 0.3s ease;
            background-color: #f5f5f5;
            /* Initial background color */
            color: #333;
            /* Text color */
            border: none;
            border-radius: 10px;
        }

        /* Hover effect for the cards */
        .card:hover {
            background-color: #017267;
            /* Change background color on hover */
            color: #fff;
            /* Change text color on hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Add shadow effect on hover */
            transform: translateY(-5px);
            /* Slight lift effect */
        }

        /* Icon styles */
        .icon-container i {
            color: #017267;
            /* Initial icon color */
            transition: color 0.3s ease;
        }

        /* Icon color change on hover */
        .card:hover .icon-container i {
            color: #fff;
            /* Change icon color on hover */
        }

        /* Chart styles */
        .chart-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for Products by Category
        const productData = @json($productData);
        const productLabels = Object.keys(productData);
        const productCounts = Object.values(productData);

        // Data for Brands Overview
        const brandData = @json($brandData);
        const brandLabels = Object.keys(brandData);
        const brandCounts = Object.values(brandData);

        // Products by Category Chart
        const productCtx = document.getElementById('productChart').getContext('2d');
        new Chart(productCtx, {
            type: 'pie',
            data: {
                labels: productLabels,
                datasets: [{
                    label: 'Products by Category',
                    data: productCounts,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Brands Overview Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: brandLabels,
                datasets: [{
                    label: 'Brands Overview',
                    data: brandCounts,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
@endsection
