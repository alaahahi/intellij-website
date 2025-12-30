@extends('layouts.app')

@section('title', 'خريطة الموقع - التطبيق الذكي')

@section('description', 'خريطة الموقع - تصفح جميع صفحات موقع التطبيق الذكي بسهولة')

@section('keywords', 'خريطة الموقع, sitemap, صفحات الموقع')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'خريطة الموقع'])

    <main id="main-content" role="main">
    <!-- Sitemap Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h2 class="mb-1 text-primary h5">خريطة الموقع</h2>
                <h1 class="display-5 mb-4">تصفح جميع صفحات الموقع</h1>
                <p class="mb-0">استخدم هذه الصفحة للوصول السريع إلى جميع صفحات موقعنا. يمكنك أيضاً استخدام XML Sitemap للمحركات البحث.
                </p>
            </div>

            <div class="row g-5">
                <!-- الصفحات الرئيسية -->
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sitemap-section">
                        <h3 class="mb-4 text-primary"><i class="fas fa-home me-2"></i>الصفحات الرئيسية</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('home') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>الصفحة الرئيسية</a></li>
                            <li class="mb-2"><a href="{{ route('about') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>من نحن</a></li>
                            <li class="mb-2"><a href="{{ route('contact') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>اتصل بنا</a></li>
                        </ul>
                    </div>
                </div>

                <!-- الخدمات والمنتجات -->
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="sitemap-section">
                        <h3 class="mb-4 text-primary"><i class="fas fa-briefcase me-2"></i>الخدمات والمنتجات</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('service') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>خدماتنا</a></li>
                            <li class="mb-2"><a href="{{ route('contracts-system') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>نظام عقود بيع السيارات</a></li>
                            <li class="mb-2"><a href="{{ route('accounting-system') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>برنامج المحاسب الذكي</a></li>
                            <li class="mb-2"><a href="{{ route('feature') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>المميزات</a></li>
                        </ul>
                    </div>
                </div>

                <!-- صفحات إضافية -->
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="sitemap-section">
                        <h3 class="mb-4 text-primary"><i class="fas fa-file-alt me-2"></i>صفحات إضافية</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('pricing') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>الأسعار</a></li>
                            <li class="mb-2"><a href="{{ route('testimonial') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>آراء العملاء</a></li>
                            <li class="mb-2"><a href="{{ route('blog') }}" class="text-dark"><i class="fas fa-chevron-left me-2"></i>المشاريع</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- XML Sitemap Link -->
            <div class="row mt-5">
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.7s">
                    <div class="bg-light rounded p-4">
                        <h4 class="mb-3">XML Sitemap للمحركات البحث</h4>
                        <p class="mb-3">يمكنك الوصول إلى XML Sitemap للموقع من خلال الرابط التالي:</p>
                        <a href="{{ route('sitemap') }}" class="btn btn-primary rounded-pill px-5" target="_blank">
                            <i class="fas fa-sitemap me-2"></i>عرض XML Sitemap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sitemap End -->
    </main>

    @include('components.footer')
@endsection

@push('styles')
<style>
    .sitemap-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 10px;
        height: 100%;
        transition: all 0.3s ease;
    }
    .sitemap-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .sitemap-section ul li a {
        text-decoration: none;
        transition: all 0.3s ease;
        display: block;
        padding: 0.5rem;
        border-radius: 5px;
    }
    .sitemap-section ul li a:hover {
        background: var(--bs-primary);
        color: white !important;
        padding-right: 1rem;
    }
</style>
@endpush

