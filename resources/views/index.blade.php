@extends('layouts.simple.master')

@section('title', 'Home')

@section('layouts.simple.css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/range-slider.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Welcome to Our Store</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="container-fluid home-wrapper">

        <!-- Menu Bar -->
        <div class="menu-bar">
            <!-- Add your menu items here -->
        </div>

        <!-- Cover Image -->
        <div class="cover-image">
            <img src="{{ asset('assets/images/store-cover.jpg') }}" class="img-fluid w-100" alt="Cover Image">
        </div>

        <!-- Featured Products -->
        <div class="product-grid">
            <div class="row">
                @isset($products)
                    @foreach($products as $product)
                <div class="col-md-8">
                    <div class="card">
                        <div class="product-box">
                            <!-- Product 1: 2 Grid Size -->
                            <div class="product-img">
                                <img src="{{ asset('assets/images/products/product-1.jpg') }}" class="img-fluid" alt="Product 1">
                            </div>
                            <div class="product-details">
                                <h4>{{$product->name}}</h4>
                                <p>{{$product->description}}.</p>
                                <div class="product-price">$50.00</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endisset
                </div><!-- end row -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="product-box">
                            <!-- Product 2: 2 Grid Size -->
                            <div class="product-img">
                                <img src="{{ asset('assets/images/products/product-2.jpg') }}" class="img-fluid" alt="Product 2">
                            </div>
                            <div class="product-details">
                                <h4>Product 2</h4>
                                <p>Description of product 2.</p>
                                <div class="product-price">$40.00</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="product-box">
                            <!-- Product 3: Full Width Product -->
                            <div class="product-img">
                                <img src="{{ asset('assets/images/products/product-3.jpg') }}" class="img-fluid" alt="Product 3">
                            </div>
                            <div class="product-details">
                                <h4>Product 3</h4>
                                <p>Description of product 3.</p>
                                <div class="product-price">$80.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Best Selling Products -->
        <div class="best-selling-section">
            <h3>Best Selling Products</h3>
            <div class="row">
                <!-- Left Side (4 Products) -->
                <div class="col-md-8">
                    <div class="row">
                        @isset($bestSellingProductsLeft)
                        @foreach($bestSellingProductsLeft as $product)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="product-box">
                                        <div class="product-img">
                                            <img src="{{ asset('storage/' . $product->images[0]) }}" class="img-fluid" alt="{{ $product->name }}">
                                        </div>
                                        <div class="product-details">
                                            <h4>{{ $product->name }}</h4>
                                            <p>{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                                            <div class="product-price">${{ number_format($product->price, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endisset
                    </div>
                </div>

                <!-- Right Side (1 Big Product) -->
                <div class="col-md-4">
                    @isset($products)
                    @foreach($products as $product)
                        <div class="card">
                            <div class="product-box">
                                <div class="product-img">
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" class="img-fluid" alt="{{ $product->name }}">
                                </div>
                                <div class="product-details">
                                    <h4>{{ $product->name }}</h4>
                                    <p>{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endisset
                </div>
            </div>
        </div>

        <!-- Image Section (Full Width) -->
        <div class="full-width-image">
            <img src="{{ asset('assets/images/store-banner.jpg') }}" class="img-fluid w-100" alt="Banner Image">
        </div>

        <!-- Customer Testimonials Carousel -->
        <div class="customer-testimonials">
            <h3>What Our Customers Say</h3>
            <div id="customerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @isset($testimonials)
                    @foreach($testimonials as $key => $testimonial)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="testimonial">
                                <p>{{ $testimonial->message }}</p>
                                <h5>{{ $testimonial->customer_name }}</h5>
                                <p>{{ $testimonial->customer_location }}</p>
                            </div>
                        </div>
                    @endforeach
                    @endisset
                </div>
                <a class="carousel-control-prev" href="#customerCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#customerCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>&copy; 2025 Our Store. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/range-slider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/range-slider/rangeslider-script.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Customer Testimonials Carousel initialization
            $('#customerCarousel').carousel({
                interval: 5000
            });
        });
    </script>
@endsection
