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

    <!-- Preconnect to CDNs for faster loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://use.fontawesome.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://code.jquery.com">
    
    <!-- Preload Critical Images -->
    <link rel="preload" as="image" href="{{ asset('img/logo.png') }}">
    <link rel="preload" as="image" href="{{ asset('img/account/1.png') }}"> 

    <!-- Google Web Fonts - Load asynchronously to improve FCP -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Tajawal:wght@400;500;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet"></noscript>

    <!-- Icon Font Stylesheet - Load asynchronously -->
    <link rel="preload" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"></noscript>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"></noscript>

    <!-- Critical CSS - Load immediately with preload for faster FCP -->
    <link rel="preload" href="{{ asset('css/bootstrap.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"></noscript>
    <link rel="preload" href="{{ asset('css/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="{{ asset('css/style.css') }}" rel="stylesheet"></noscript>
    
    <!-- Non-critical CSS - Will be loaded asynchronously via JavaScript -->
    
    <!-- Critical CSS Inline - Improves FCP -->
    <style>
        /* Critical CSS for above-the-fold content */
        body { 
            font-family: system-ui, -apple-system, 'Segoe UI', 'Tajawal', 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
        }
        h1, h2, h3, h4, h5, h6 { 
            font-family: system-ui, -apple-system, 'Segoe UI', 'Cairo', sans-serif;
            margin: 0;
        }
        .navbar {
            min-height: 70px;
        }
        .navbar-brand img {
            width: auto;
            height: 55px;
            max-width: 150px;
            display: block;
        }
        .hero-header {
            padding-top: 160px;
            padding-bottom: 100px;
        }
        .hero-header h1 {
            font-size: 2.5rem;
            line-height: 1.2;
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
        
        /* FontAwesome font-display optimization */
        @font-face {
            font-family: 'Font Awesome 5 Free';
            font-display: swap;
        }
        
        @font-face {
            font-family: 'Font Awesome 5 Brands';
            font-display: swap;
        }
        
        
        /* Reserve space for service items */
        .service-item {
            min-height: 300px;
        }
        
        /* Disable animations in hero-header section */
        .hero-header *,
        .hero-header::before,
        .hero-header::after {
            animation: none !important;
        }
        
        .hero-header .rotate-img,
        .hero-header .rotate-img *,
        .hero-header .rotate-img img,
        .hero-header .rotate-sty-2 {
            animation: none !important;
        }
        
        /* Disable WOW.js animations in hero-header */
        .hero-header .wow {
            animation: none !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
    
    <!-- Structured Data (JSON-LD) -->
    @yield('structured_data')
    
    <!-- Google Analytics 4 -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BLHFYJKFQV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-BLHFYJKFQV');
    </script>
    
    @stack('styles')
</head>

<body>
    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable position-absolute top-0 start-0 bg-primary text-white p-2 text-decoration-none" style="z-index: 9999; transform: translateY(-100%); transition: transform 0.3s;" onfocus="this.style.transform='translateY(0)';" onblur="this.style.transform='translateY(-100%)';">انتقل إلى المحتوى الرئيسي</a>
    
    <!-- Spinner Start - Hidden by default for faster FCP -->
    <div id="spinner" class="bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center" style="display: none !important;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    
    <!-- Load CSS asynchronously script -->
    <script>
        !function(e){"use strict";var t=function(t,n,o){var i,r=e.document,a=r.createElement("link");if(n)i=n;else{var l=(r.body||r.getElementsByTagName("head")[0]).childNodes;i=l[l.length-1]}var d=r.styleSheets;a.rel="stylesheet",a.href=t,a.media="only x",function e(t){if(r.body)return t();setTimeout(function(){e(t)})}(function(){i.parentNode.insertBefore(a,n?i:i.nextSibling)});var f=function(e){for(var t=a.href,n=d.length;n--;)if(d[n].href===t)return e();setTimeout(function(){f(e)})};return a.addEventListener&&a.addEventListener("load",function(){this.media=o||"all"}),a.onloadcssdefined=f,f(function(){}),a};"undefined"!=typeof exports?exports.loadCSS=t:e.loadCSS=t}("undefined"!=typeof global?global:this);
    </script>

    @yield('content')

    <!-- Back to Top -->
    <a href="#top" class="btn btn-primary btn-lg-square back-to-top" aria-label="العودة للأعلى"><i class="fa fa-arrow-up"></i></a>   

    <!-- JavaScript Libraries - Load with defer for non-blocking -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}" defer></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}" defer></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}" defer></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}" defer></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}" defer></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}" defer></script>
    
    <!-- Load non-critical CSS asynchronously -->
    <script>
        // Load CSS asynchronously
        function loadCSS(href) {
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = href;
            document.head.appendChild(link);
        }
        
        // Load non-critical CSS after page load
        window.addEventListener('load', function() {
            loadCSS('{{ asset("lib/animate/animate.min.css") }}');
            loadCSS('{{ asset("lib/owlcarousel/assets/owl.carousel.min.css") }}');
            loadCSS('{{ asset("lib/lightbox/css/lightbox.min.css") }}');
        });
    </script>
    @stack('scripts')
</body>
</html>
