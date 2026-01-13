@extends('layouts.app')

@section('title', '404 - الصفحة غير موجودة | IntelliJ App')

@section('description', 'الصفحة التي تبحث عنها غير موجودة. قد تكون تم نقلها أو حذفها.')

@section('keywords', '404, صفحة غير موجودة, خطأ')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => '404 - الصفحة غير موجودة'])

    <main id="main-content" role="main">
    <!-- 404 Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="mb-5">
                        <i class="bi bi-exclamation-triangle display-1 text-primary mb-4"></i>
                        <h1 class="display-1 fw-bold text-primary mb-3">404</h1>
                        <h2 class="mb-4">الصفحة غير موجودة</h2>
                        <p class="mb-4 fs-5 text-muted">
                            عذراً، الصفحة التي تبحث عنها غير موجودة في موقعنا! 
                            ربما تم نقلها أو حذفها. يمكنك العودة إلى الصفحة الرئيسية أو استخدام القائمة للتنقل.
                        </p>
                    </div>
                    
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary rounded-pill py-3 px-5">
                            <i class="fas fa-home me-2"></i>العودة للصفحة الرئيسية
                        </a>
                        <a href="{{ route('service') }}" class="btn btn-outline-primary rounded-pill py-3 px-5">
                            <i class="fas fa-briefcase me-2"></i>استكشف خدماتنا
                        </a>
                    </div>

                    <!-- Quick Links -->
                    <div class="mt-5 pt-4">
                        <h4 class="mb-4">روابط سريعة:</h4>
                        <div class="row g-3 justify-content-center">
                            <div class="col-auto">
                                <a href="{{ route('about') }}" class="btn btn-light rounded-pill px-4">من نحن</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('service') }}" class="btn btn-light rounded-pill px-4">الخدمات</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('contact') }}" class="btn btn-light rounded-pill px-4">اتصل بنا</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('blog') }}" class="btn btn-light rounded-pill px-4">المشاريع</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->
    </main>

    @include('components.footer')
@endsection

@push('styles')
<style>
    .display-1 {
        font-size: 8rem;
        font-weight: 700;
        line-height: 1;
    }
    
    @media (max-width: 768px) {
        .display-1 {
            font-size: 5rem;
        }
    }
    
    .bi-exclamation-triangle {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.05);
        }
    }
</style>
@endpush
