@php
    $defaultTitle = 'التطبيق الذكي - حلول تقنية متطورة';
    $defaultDescription = 'شركة تقنية متخصصة في تطوير الحلول البرمجية والأنظمة الإلكترونية للمعارض والشركات';
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title>@yield('title', $defaultTitle)</title>
    <meta name="title" content="@yield('title', $defaultTitle)">
    <meta name="description" content="@yield('description', $defaultDescription)">
    <meta name="keywords" content="@yield('keywords', 'حلول تقنية, برمجيات, تطوير المواقع, أنظمة إلكترونية, برمجة, تطوير تطبيقات, أنظمة محاسبة, عقود إلكترونية, محاسبة, محاسبة شركات, معارض السيارات, اربيل, بغداد')">
    <meta name="author" content="التطبيق الذكي">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <meta name="language" content="Arabic">
    <meta name="revisit-after" content="7 days">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="@hasSection('og_title') @yield('og_title') @else @yield('title', $defaultTitle) @endif">
    <meta property="og:description" content="@hasSection('og_description') @yield('og_description') @else @yield('description', $defaultDescription) @endif">
    <meta property="og:image" content="@yield('og_image', asset('img/logo.png'))">
    <meta property="og:locale" content="ar_AR">
    <meta property="og:site_name" content="التطبيق الذكي">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="@yield('twitter_url', url()->current())">
    <meta name="twitter:title" content="@hasSection('twitter_title') @yield('twitter_title') @else @yield('title', $defaultTitle) @endif">
    <meta name="twitter:description" content="@hasSection('twitter_description') @yield('twitter_description') @else @yield('description', $defaultDescription) @endif">
    <meta name="twitter:image" content="@yield('twitter_image', asset('img/logo.png'))">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#6610f2">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

    <!-- Google Web Fonts - Arabic Support -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Preload Critical Images -->
    <link rel="preload" as="image" href="{{ asset('img/logo.png') }}">
    <link rel="preload" as="image" href="{{ asset('img/account/1.png') }}"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- RTL Support & CLS Optimization -->
    <style>
        body { 
            font-family: 'Tajawal', 'Cairo', sans-serif; 
        }
        h1, h2, h3, h4, h5, h6 { 
            font-family: 'Cairo', sans-serif; 
        }
        
        /* CLS Optimization - Prevent Layout Shift */
        .hero-header img,
        .RotateMoveLeft img {
            aspect-ratio: attr(width) / attr(height);
            max-width: 100%;
            height: auto;
        }
        
        /* Reserve space for images */
        .hero-header .col-lg-6:last-child {
            min-height: 400px;
        }
        
        .RotateMoveLeft {
            min-height: 400px;
        }
        
        /* Prevent font swap layout shift */
        @font-face {
            font-family: 'Cairo';
            font-display: swap;
        }
        
        @font-face {
            font-family: 'Tajawal';
            font-display: swap;
        }
        
        /* Fix navbar logo */
        .navbar-brand img {
            width: auto;
            height: 55px;
            max-width: 150px;
            display: block;
        }
        
        /* Reserve space for service items */
        .service-item {
            min-height: 300px;
        }
    </style>
    
    <!-- Structured Data (JSON-LD) -->
    @yield('structured_data')
    
    <!-- Google Analytics 4 -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JS98BQW6M5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-JS98BQW6M5');
    </script>
    
    @stack('styles')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    @yield('content')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
