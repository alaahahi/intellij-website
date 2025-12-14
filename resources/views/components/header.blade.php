@php
    $currentRoute = request()->route()->getName() ?? 'home';
@endphp

<!-- Navbar & Hero Start -->
<div class="container-fluid {{ $headerClass ?? 'p-0' }}">
    <nav class="navbar navbar-expand-lg {{ $navbarClass ?? 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0' }}">
        <a href="{{ route('home') }}" class="navbar-brand p-0 d-flex align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="التطبيق الذكي" style="height: 55px; width: auto;" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ $currentRoute == 'home' ? 'active' : '' }}">الرئيسية</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ $currentRoute == 'about' ? 'active' : '' }}">من نحن</a>
                <a href="{{ route('service') }}" class="nav-item nav-link {{ $currentRoute == 'service' ? 'active' : '' }}">خدماتنا</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">المشاريع</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('contracts-system') }}" class="dropdown-item">نظام العقود الإلكترونية</a>
                        <a href="{{ route('feature') }}" class="dropdown-item">المميزات</a>
                        <a href="{{ route('testimonial') }}" class="dropdown-item">آراء العملاء</a>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ $currentRoute == 'contact' ? 'active' : '' }}">اتصل بنا</a>
            </div>
        </div>
    </nav>

    @if(isset($showHero) && $showHero)
        <!-- Hero Header Start -->
        <div class="hero-header overflow-hidden px-5">
            <div class="rotate-img">
                <img src="{{ asset('img/sty-1.png') }}" class="img-fluid w-100" alt="">
                <div class="rotate-sty-2"></div>
            </div>
            <div class="row gy-5 align-items-center">
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.1s">
                    <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">حلول تقنية متطورة لمستقبل أفضل</h1>
                    <p class="fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">نقدم حلول برمجية مبتكرة وأنظمة إلكترونية متطورة لتلبية احتياجات الشركات والمؤسسات. نساعدك في تحويل أفكارك إلى واقع رقمي.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.7s">ابدأ الآن</a>
                </div>
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <img src="{{ asset('img/hero-img-1.png') }}" class="img-fluid w-100 h-100" alt="حلول تقنية">
                </div>
            </div>
        </div>
        <!-- Hero Header End -->
    @endif
</div>
<!-- Navbar & Hero End -->
