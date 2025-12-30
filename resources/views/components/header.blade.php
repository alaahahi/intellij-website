@php
    $currentRoute = request()->route()->getName() ?? 'home';
@endphp

<!-- Navbar & Hero Start -->
<header class="container-fluid {{ $headerClass ?? 'p-0' }}">
    <nav class="navbar navbar-expand-lg {{ $navbarClass ?? 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0' }}" role="navigation" aria-label="القائمة الرئيسية">
        <a href="{{ route('home') }}" class="navbar-brand p-0 d-flex align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="التطبيق الذكي" width="150" height="55" style="height: 55px; width: auto; max-width: 150px;" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="فتح/إغلاق القائمة" aria-expanded="false" aria-controls="navbarCollapse">
            <span class="fa fa-bars" aria-hidden="true"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ $currentRoute == 'home' ? 'active' : '' }}">الرئيسية</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ $currentRoute == 'about' ? 'active' : '' }}">من نحن</a>
                <a href="{{ route('service') }}" class="nav-item nav-link {{ $currentRoute == 'service' ? 'active' : '' }}">خدماتنا</a>
                <a href="{{ route('pricing') }}" class="nav-item nav-link {{ $currentRoute == 'pricing' ? 'active' : '' }}">الأسعار</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">المشاريع</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('contracts-system') }}" class="dropdown-item">نظام عقود بيع السيارات</a>
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
        <div class="hero-header overflow-hidden px-5" style="min-height: 500px; position: relative;">
            <div class="rotate-img" style="position: absolute; width: 100%; height: 100%; z-index: -1; top: 0; left: 0;">
                <img src="{{ asset('img/sty-1.png') }}" class="img-fluid w-100" alt="" loading="lazy" width="1920" height="1080" style="opacity: 0.1;">
                <div class="rotate-sty-2"></div>
            </div>
            <div class="row gy-5 align-items-center">
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.1s">
                    <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">حلول تقنية متطورة لبرامج المحاسبة وأنظمة المعارض</h1>
                    <p class="fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">نقدم حلول برمجية مبتكرة وأنظمة إلكترونية متطورة لتلبية احتياجات الشركات والمؤسسات. نساعدك في تحويل أفكارك إلى واقع رقمي.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.7s">ابدأ الآن</a>
                </div>
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s" style="min-height: 400px; aspect-ratio: 16/9;">
                    <img src="{{ asset('img/account/1.png') }}" class="img-fluid w-100 h-100" alt="برنامج محاسب ذكي مع مخزن - حلول تقنية متطورة" loading="eager" width="600" height="400" style="object-fit: contain; display: block;">
                </div>
            </div>
        </div>
        <!-- Hero Header End -->
    @endif
</header>
<!-- Navbar & Hero End -->
