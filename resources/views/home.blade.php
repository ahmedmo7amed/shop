@extends('layouts.app')

<style>
    .industrial-header {
        url('{{ asset('assets/images/banner/pexels-photo-15798797-1024x682.jpg') }}') center/cover;
        padding: 6rem 0;
    }

    /* التعديلات الجديدة للبطاقات */
    .card.industrial-card {
        min-width: 300px;
        max-width: 100%;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform 0.3s;
        border-radius: 15px;
    }

    .card-header {
        height: 250px;
        flex-shrink: 0;
        overflow: hidden;
    }

    .card-header img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
    }

    .specs-container {
        flex-grow: 1;
    }

    .description-container {
        flex-shrink: 0;
        position: relative;
        max-height: 72px;
        overflow: hidden;
        grid-template-columns: 300px 1fr;
    }

    .description-container::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 20px;
         }

    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        margin-bottom: 0.5rem !important;
    }

    .price-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }

    .btn-industrial {
        white-space: nowrap;
    }

    /* باقي الأنماط */
    .industrial-card:hover {
        transform: translateY(-10px);
    }

    .contact-section {
        background: #2b2d42;
    }



    .spec-item {
        min-height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0.5rem;
    }

    .object-fit-cover { object-fit: cover }
    .object-fit-contain { object-fit: contain }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-img {
        position: relative;
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
    }

    .product-hover {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-box:hover .product-hover {
        opacity: 1;
    }

    .card {
        transition: transform 0.3s;
        min-height: 500px; /* ارتفاع ثابت للبطاقة */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    .img-c{
        max-height: 300px;
    }
    :root {
        --bs-font-sans-serif: "Cairo", sans-serif; /* استبدل الخطوط القديمة بخط Cairo */
    }

    body {
        font-family: var(--bs-font-sans-serif); /* تأكد من تطبيق الخط على النص العام */
        font-optical-sizing: auto;
        font-weight: 400; /* اختر الوزن المناسب (200 إلى 1000) */
        font-style: normal;
        font-variation-settings: "slnt" 0;
    }

</style>

@section('content')
    <!-- الهيدر والمحتوى الآخر يبقى كما هو -->

    <main class="products py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold text-dark">نماذج من منتجاتنا</h2>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($categories as $category)
                    @php

                        $product = $category->products->first();
                        if(!$product) continue;
                        $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                    @endphp

                    <div class="col">
                        <div class="card industrial-card h-100 shadow-lg border-0">
                            <div class="card-header p-0 position-relative">
                                @if(!empty($images) && isset($images[0]))
                                    <img src="{{ asset('storage/' . $images[0]) }}"
                                         class="card-img-top"
                                         alt="{{ $product->name}}">
                                @else
                                    <img src="{{ asset('storage/product-images/default.jpg') }}"
                                         class="card-img-top"
                                         alt="Default image">
                                @endif

                                <div class="price-badge">
                                    <span class="badge bg-danger fs-5">{{ number_format($product->price) }} ريال</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title fw-bold text-dark mb-3">{{ $product->name}}</h3>

                                <div class="specs-container mb-3">
                                    <div class="row g-2">
                                        @foreach($product->options as $option)
                                            @php
                                                $firstValue = $option->values->first();
                                            @endphp
                                            <div class="col-6 mb-2">
                                                <div class="spec-item bg-dark p-2 rounded">
                                                    <i class="fas fa-ruler-combined text-danger"></i>
                                                    السعة: {{ $firstValue->value }} لتر
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <div class="spec-item bg-dark p-2 rounded">
                                                    <i class="fas fa-ruler-combined text-danger"></i>
                                                    الارتفاع: {{ $firstValue->height }} سم
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <div class="spec-item bg-dark p-2 rounded">
                                                    <i class="fas fa-layer-group text-danger"></i>
                                                    الطول: {{ $firstValue->length }} مم
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <div class="spec-item bg-dark p-2 rounded">
                                                    <i class="fas fa-paint-roller text-danger"></i>
                                                    القطر: {{ $firstValue->diameter }} سم
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="description-container mt-auto">
                                    <p class="card-text text-secondary">
                                        {{ \Illuminate\Support\Str::limit($product->description, 100) }}
                                    </p>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent border-0 pb-3 pt-3">
                                <div class="d-grid gap-2">
                                    @php
                                        // بناء نص الرسالة
                                        $message = 'أرغب في طلب المنتج التالي: ' . urlencode($product->name) . '%0A';
                                        $message .= 'رابط المنتج: ' . urlencode(url('products/' . $product->id)) . '%0A';

                                        foreach($product->options as $option) {
                                            $firstValue = $option->values->first();
                                            $message .= urlencode('السعة: ' . ($firstValue->value ?? 'N/A') . ' لتر ') . '%0A';
                                            $message .= urlencode('الارتفاع: ' . ($firstValue->height ?? 'N/A') . ' سم ') . '%0A';
                                            $message .= urlencode('الطول: ' . ($firstValue->length ?? 'N/A') . ' مم ') . '%0A';
                                            $message .= urlencode('القطر: ' . ($firstValue->diameter ?? 'N/A') . ' سم ') . '%0A';
                                        }
                                    @endphp

                                    <a href="https://wa.me/249128436851?text={{ $message }}"
                                       class="btn btn-industrial btn-lg btn-danger text-white text-decoration-none"
                                       target="_blank">
                                        <i class="fas fa-file-invoice-dollar me-2"></i>
                                        اطلب عرض سعر
                                    </a>

                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="btn btn-outline-dark btn-lg">
                                        التفاصيل الفنية
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>


<nav class="bg-gray-900 shadow-xl sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center">
                    <i class="fas fa-industry text-red-600 text-3xl mr-2"></i>
                    <span class="text-2xl font-bold text-white">
                        <span class="text-red-600">صناعات</span> الحديد
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">

                <!-- CTA Button -->
                <a href="#" class="ml-8 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-medium transition-colors duration-300 flex items-center">
                    <i class="fas fa-file-invoice mr-2"></i>اطلب عرض سعر
                </a>
            </div>
        </div>

    </div>
</nav>


<div class="container-fluid product-wrapper">
    <div class="product-grid">
        <div class="feature-products">
            <div class="row">

                <div class="col-md-6 text-sm-end">
                    @auth
                        @if(auth()->user()->can('create', App\Models\Product::class))
                            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
                                <i data-feather="plus"></i> Add New Product
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">

                <!-- Products Grid -->
                <div class="col-md-12">
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-xl-3 col-sm-6 xl-3">
                                <div class="card">
                                    <div class="product-box">
                                        <div class="product-img ">
                                            @if($product->images)
                                                <div id="productCarousel{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach($product->images as $key => $image)
                                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                <img class="img-fluid img-c" src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <a class="carousel-control-prev" href="#productCarousel{{ $product->id }}" role="button" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#productCarousel{{ $product->id }}" role="button" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </a>
                                                </div>
                                            @else
                                                <img class="img-fluid" src="{{ asset('assets/images/product/default.png') }}" alt="Default Product Image">
                                            @endif
                                            <div class="product-hover">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('products.show', $product) }}" class="btn" type="button">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>
                                                    @auth
                                                        @if(auth()->user()->can('update', $product))
                                                            <li>
                                                                <a href="{{ route('products.edit', $product) }}" class="btn" type="button">
                                                                    <i data-feather="edit"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        @if(auth()->user()->can('delete', $product))
                                                            <li>
                                                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this product?')">
                                                                        <i data-feather="trash-2"></i>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    @endauth
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-details">
                                            <h4>{{ $product->name }}</h4>
                                            <p>{{\Illuminate\Support\Str::limit($product->description, 100) }}</p>
                                            <div class="product-price">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    No products found.
                                </div>
                            </div>
                        @endforelse
                    </div>

{{--                    <!-- Pagination -->--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12">--}}
{{--                            --}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <!-- Product item-->
                @foreach($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <img class="card-img-top" src="{{"storage/".$product->images[0]}}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">

                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$product->name}}</h5>
                                <p>{{\Illuminate\Support\Str::limit($product->description, 100) }}</p>

                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                @if(isset($product->discount_price))
                                    <span class="text-muted text-decoration-line-through">{{$product->price}}</span>
                                    <div class="product-price">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                @else
                                    <div class="product-price">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                @endif

                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#"> أطلب من الواتس أب </a></div>
                        </div>
                        <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#"> أطلب عرض سعر </a></div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
<!-- قسم الاتصال -->
<section id="contact" class="contact-section bg-dark text-white py-5">
    <div class="container text-center">
        <h2 class="mb-4">للحصول على استشارة فنية</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="contact-form">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-lg" placeholder="الاسم الكامل">
                        </div>
                        <div class="col-md-6">
                            <input type="tel" class="form-control form-control-lg" placeholder="رقم الجوال">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control form-control-lg"
                                      rows="4"
                                      placeholder="المواصفات المطلوبة"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-danger btn-lg w-100">
                                إرسال الطلب
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection
