@extends('layouts.app')

@section('title', 'مشروع Dream City Mall - نظام إدارة مول تجاري | IntelliJ App')

@section('description', 'نظام شامل لإدارة المولات التجارية - إدارة المحلات، الإيجارات، العملاء، والمبيعات. حل متكامل لإدارة المراكز التجارية - IntelliJ App')

@section('keywords', 'نظام إدارة مول, إدارة مول تجاري, إدارة مراكز تجارية, إدارة محلات, إدارة إيجارات, نظام إدارة تجاري, اربيل, بغداد')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "نظام إدارة Dream City Mall",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "Web",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "USD"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "ratingCount": "200"
  },
  "description": "نظام شامل ومتكامل لإدارة المولات التجارية والمراكز التجارية. يوفر حلولاً احترافية لإدارة المحلات، الإيجارات، العملاء، والمبيعات. مناسب للمولات التجارية في اربيل وبغداد",
  "keywords": "إدارة مول, إدارة مراكز تجارية, نظام إدارة تجاري, اربيل, بغداد"
}
</script>
@endsection

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'مشروع Dream City Mall'])

    <main id="main-content" role="main">
    <!-- Dream City Mall Project Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Header Section -->
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h2 class="mb-1 text-primary h5">مشروع Dream City Mall</h2>
                <h1 class="display-5 mb-4">نظام شامل يخدم المولات التجارية والمراكز التجارية</h1>
                <p class="mb-0">نظام متكامل ومتطور لإدارة جميع جوانب المولات التجارية والمراكز التجارية. يوفر حلولاً احترافية لإدارة المحلات، الإيجارات، العملاء، المبيعات، والتقارير المالية. مصمم خصيصاً لتلبية احتياجات المولات التجارية في بغداد.
                </p>
            </div>

            <!-- Image Section with Effects -->
            <div class="row g-5 mb-5">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative overflow-hidden rounded shadow-lg dream-city-container" style="border-radius: 20px !important;">
                        <img src="{{ asset('img/dream-city-mall/WhatsApp Image 2026-01-01 at 21.52.35.jpeg') }}" 
                             class="img-fluid w-100 dream-city-image" 
                             alt="مشروع Dream City Mall - نظام إدارة مول تجاري" 
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
                                <i class="fas fa-store fa-4x mb-3" style="text-shadow: 0 4px 10px rgba(0,0,0,0.5); animation: pulse 2s infinite;"></i>
                                <h3 class="fw-bold" style="text-shadow: 0 2px 8px rgba(0,0,0,0.5);">Dream City Mall</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="row">
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">هل أنت مستعد لتحسين إدارة مولك التجاري؟</h3>
                    <p class="mb-4">تواصل معنا اليوم لمعرفة المزيد عن نظام إدارة Dream City Mall وكيف يمكنه مساعدتك</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 me-3">تواصل معنا</a>
                    <a href="{{ route('service') }}" class="btn btn-light rounded-pill py-3 px-5">عودة للخدمات</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Dream City Mall Project End -->
    </main>

    @include('components.footer')
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
