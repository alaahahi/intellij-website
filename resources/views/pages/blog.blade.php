@extends('layouts.app')

@section('title', 'المشاريع - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'المشاريع'])

    <main id="main-content" role="main">
    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">المشاريع</h4>
                <h1 class="display-5 mb-4">مشاريعنا المتميزة</h1>
                <p class="mb-0">استعرض بعضاً من المشاريع الناجحة التي قمنا بتطويرها لعملائنا.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- نظام عقود بيع السيارات -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/contracts-system/1.png') }}" class="img-fluid w-100" alt="نظام عقود بيع السيارات لمعارض السيارات" loading="lazy">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4">
                            <h5 class="mb-4">نظام عقود بيع السيارات</h5>
                            <p class="mb-4">نظام شامل لإدارة عقود بيع السيارات للمعارض مع توقيع إلكتروني آمن. <a href="{{ route('contracts-system') }}" class="text-primary text-decoration-none">للمزيد عن نظام عقود بيع السيارات اضغط هنا</a></p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('contracts-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                
                <!-- برنامج المحاسب الذكي -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/account/1.png') }}" class="img-fluid w-100" alt="برنامج محاسب ذكي مع مخزن - نظام محاسبة متكامل" loading="lazy">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4">
                            <h5 class="mb-4">برنامج المحاسب الذكي</h5>
                            <p class="mb-4">نظام متكامل للمحاسبة وإدارة المستودعات والمشتريات. <a href="{{ route('accounting-system') }}" class="text-primary text-decoration-none">للمزيد عن برنامج المحاسب الذكي اضغط هنا</a></p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('accounting-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                
                <!-- نظام إدارة سفينة الشحن -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/shipping/1.png') }}" class="img-fluid w-100" alt="نظام إدارة سفينة الشحن - إدارة نقل السيارات" loading="lazy" style="object-fit: cover; height: 250px;">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4">
                            <h5 class="mb-4">نظام إدارة سفينة الشحن</h5>
                            <p class="mb-4">نظام شامل لإدارة سفينة شحن واحدة لنقل السيارات. <a href="{{ route('shipping-system') }}" class="text-primary text-decoration-none">للمزيد عن نظام إدارة سفينة الشحن اضغط هنا</a></p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('shipping-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                
                <!-- شركة الهدف المباشر -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/dream-city-mall/WhatsApp Image 2026-01-01 at 21.52.35.jpeg') }}" class="img-fluid w-100" alt="شركة الهدف المباشر - خدمات التسويق في بغداد" loading="lazy" style="object-fit: cover; height: 250px;">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4">
                            <h5 class="mb-4">شركة الهدف المباشر</h5>
                            <p class="mb-4">خدمات التسويق المتطورة في بغداد. <a href="{{ route('dream-city-mall') }}" class="text-primary text-decoration-none">للمزيد عن شركة الهدف المباشر اضغط هنا</a></p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('dream-city-mall') }}">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
    </main>

    @include('components.footer')
@endsection
