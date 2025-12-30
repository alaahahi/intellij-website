@extends('layouts.app')

@section('title', 'خدماتنا - التطبيق الذكي')

@section('description', 'نقدم مجموعة شاملة من الخدمات التقنية والبرمجية التي تغطي جميع احتياجاتك التقنية. من تطوير المواقع والتطبيقات إلى الأنظمة الإلكترونية المتخصصة')

@section('keywords', 'خدمات تقنية, تطوير المواقع, تطوير التطبيقات, أنظمة إلكترونية, برمجيات, حلول تقنية, محاسبة, محاسبة شركات, معارض السيارات, اربيل, بغداد')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "serviceType": "خدمات تقنية وبرمجية",
  "provider": {
    "@type": "Organization",
    "name": "التطبيق الذكي",
    "url": "{{ url('/') }}"
  },
  "areaServed": {
    "@type": "Country",
    "name": "العراق"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "خدمات التطبيق الذكي",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "نظام عقود بيع السيارات",
          "description": "نظام شامل لإدارة عقود بيع السيارات للمعارض"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "برنامج المحاسب الذكي",
          "description": "نظام متكامل للمحاسبة وإدارة المستودعات والمشتريات"
        }
      }
    ]
  }
}
</script>
@endsection

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'خدماتنا'])

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="mb-1 text-primary">خدماتنا</h4>
                <h1 class="display-5 mb-4">ماذا يمكننا أن نقدم لك</h1>
                <p class="mb-0">نقدم مجموعة شاملة من الخدمات التقنية والبرمجية التي تغطي جميع احتياجاتك التقنية.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- نظام عقود بيع السيارات -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-file-contract fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">نظام عقود بيع السيارات</h4>
                            <p class="mb-4">نظام شامل لإدارة عقود بيع السيارات للمعارض</p>
                            <a href="{{ route('contracts-system') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">المزيد</a>
                        </div>
                    </div>
                </div>
                
                <!-- برنامج المحاسب الذكي -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center rounded p-4 position-relative" style="background: linear-gradient(135deg, rgba(102, 16, 242, 0.1) 0%, rgba(247, 71, 128, 0.1) 100%); border: 2px solid var(--bs-primary); transform: scale(1.05); box-shadow: 0 10px 30px rgba(102, 16, 242, 0.2);">
                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-2" style="font-size: 0.75rem;">
                            <i class="fas fa-star me-1"></i> مميز
                        </span>
                        <div class="service-icon d-inline-block bg-primary rounded p-4 mb-4" style="box-shadow: 0 5px 15px rgba(102, 16, 242, 0.3);">
                            <i class="fas fa-calculator fa-5x text-white"></i>
                        </div>
                        <div class="service-content">
                            <h4 class="mb-4 text-primary fw-bold">برنامج المحاسب الذكي</h4>
                            <p class="mb-4">نظام متكامل للمحاسبة وإدارة المستودعات والمشتريات</p>
                            <a href="{{ route('accounting-system') }}" class="btn btn-primary rounded-pill text-white py-2 px-4">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    @include('components.footer')
@endsection
