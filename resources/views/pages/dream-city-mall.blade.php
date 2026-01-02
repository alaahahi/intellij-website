@extends('layouts.app')

@section('title', 'شركة الهدف المباشر - خدمات التسويق في بغداد | Dream City Mall')

@section('description', 'شركة الهدف المباشر تقدم خدمات التسويق المتطورة في بغداد. متخصصون في التسويق الرقمي والتسويق الإلكتروني للمشاريع التجارية في بغداد')

@section('keywords', 'شركة الهدف المباشر, خدمات التسويق, التسويق في بغداد, تسويق رقمي بغداد, تسويق إلكتروني بغداد, شركة تسويق بغداد, خدمات تسويق بغداد')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "شركة الهدف المباشر",
  "description": "شركة متخصصة في تقديم خدمات التسويق المتطورة في بغداد. نقدم خدمات التسويق الرقمي والتسويق الإلكتروني للمشاريع التجارية",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "بغداد",
    "addressCountry": "IQ"
  },
  "areaServed": {
    "@type": "City",
    "name": "بغداد"
  },
  "serviceType": "خدمات التسويق, التسويق الرقمي, التسويق الإلكتروني",
  "keywords": "شركة الهدف المباشر, خدمات التسويق, التسويق في بغداد, تسويق رقمي بغداد"
}
</script>
@endsection

@section('content')
    <main id="main-content" role="main">
    <!-- Dream City Mall Project Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Header Section -->
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h2 class="mb-1 text-primary h5">شركة الهدف المباشر</h2>
                <h1 class="display-5 mb-4">خدمات التسويق المتطورة في بغداد</h1>
                <p class="mb-0">شركة الهدف المباشر - متخصصون في تقديم خدمات التسويق الرقمي والتسويق الإلكتروني في بغداد. نقدم حلول تسويقية متكاملة تساعدك على تحقيق أهدافك التجارية وتوسيع نشاطك في بغداد.
                </p>
            </div>

            <!-- Image Section with Effects -->
            <div class="row g-5 mb-5">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative overflow-hidden rounded shadow-lg dream-city-container" style="border-radius: 20px !important;">
                        <img src="{{ asset('img/dream-city-mall/WhatsApp Image 2026-01-01 at 21.52.35.jpeg') }}" 
                             class="img-fluid w-100 dream-city-image" 
                             alt="شركة الهدف المباشر - خدمات التسويق في بغداد" 
                             loading="lazy"
                             style="
                                transition: transform 0.6s ease, filter 0.6s ease, box-shadow 0.6s ease;
                                transform: scale(1);
                                filter: brightness(1);
                                display: block;
                                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                             ">
                        <div class="dream-city-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                             style="
                                background: linear-gradient(135deg, rgba(102, 16, 242, 0.2) 0%, rgba(247, 71, 128, 0.2) 100%);
                                opacity: 0;
                                transition: opacity 0.6s ease;
                                pointer-events: none;
                             ">
                            <div class="text-center text-white">
                                <i class="fas fa-bullseye fa-4x mb-3" style="text-shadow: 0 4px 10px rgba(0,0,0,0.5); animation: pulse 2s infinite;"></i>
                                <h3 class="fw-bold" style="text-shadow: 0 2px 8px rgba(0,0,0,0.5);">شركة الهدف المباشر</h3>
                                <p class="mb-0" style="text-shadow: 0 2px 8px rgba(0,0,0,0.5);">خدمات التسويق في بغداد</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="row">
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">هل تبحث عن أفضل خدمات التسويق في بغداد؟</h3>
                    <p class="mb-4">تواصل مع شركة الهدف المباشر اليوم لمعرفة المزيد عن خدماتنا التسويقية وكيف يمكننا مساعدتك في تطوير عملك في بغداد</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Dream City Mall Project End -->
    </main>
@endsection

@push('styles')
<style>
    .dream-city-image {
        animation: fadeInScale 1s ease-out;
    }
    
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
    
    .dream-city-container:hover .dream-city-image {
        transform: scale(1.05);
        filter: brightness(1.1);
        box-shadow: 0 30px 80px rgba(102, 16, 242, 0.4);
    }
    
    .dream-city-container:hover .dream-city-overlay {
        opacity: 1;
    }
    
    .dream-city-image {
        cursor: pointer;
    }
</style>
@endpush
