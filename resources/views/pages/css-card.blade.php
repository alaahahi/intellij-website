@extends('layouts.app')

@section('title', 'CSS CARD - بطاقة الخدمات الصحية')

@section('description', 'بطاقة الخدمات الصحية تقدم مجموعة واسعة من الخدمات الطبية المتخصصة مثل الإنعاش الطبي والجراحي، طب النساء والتوليد، الجراحة العامة والمنظار، جراحة العظام والمفاصل، جراحة المسالك البولية، جراحة الوجه والفكين، طب وجراحة الأطفال، الجراحة التجميلية والتقويمية، جراحة الدماغ والأعصاب، جراحة الأورام، طب الغدد والسكري، أمراض القلب والشرايين، أمراض الرئة، وعلاج الآلام.')

@section('keywords', 'بطاقة الخدمات الصحية, الإنعاش الطبي, طب النساء, جراحة عامة, جراحة العظام, جراحة الأطفال, جراحة التجميل, جراحة الدماغ, علاج الأورام, أمراض القلب, أمراض الرئة, علاج الآلام')

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
                <h2 class="mb-1 text-primary h5">CSS CARD - بطاقة الخدمات الصحية</h2>
                <h1 class="display-5 mb-4">خدمات طبية متكاملة ومتخصصة</h1>
                <p class="mb-0">نقدّم مجموعة واسعة من الخدمات الطبية المتخصصة بما في ذلك الإنعاش الطبي والجراحي، طب النساء والتوليد، الجراحة العامة والمناظير، جراحة العظام والمفاصل، جراحة المسالك البولية، جراحة الوجه والفكين، طب وجراحة الأطفال، الجراحة التجميلية والتقويمية، جراحة الدماغ والأعصاب، جراحة الأورام، طب الغدد والسكري، أمراض القلب والشرايين، أمراض الرئة، وعلاج الآلام.</p>
            </div>

            <!-- Image Section with Effects -->
            <div class="row g-4 mb-5">
                <!-- Main Featured Image -->
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

                <!-- Gallery Images -->
                @foreach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30] as $index)
                <div class="col-12 wow fadeInUp" data-wow-delay="{{ 0.2 + ($index * 0.05) }}s">
                    <div class="position-relative overflow-hidden rounded shadow-lg dream-city-container" style="border-radius: 20px !important;">
                        <img src="{{ asset('img/css-card/magazine - print-' . $index . '.png') }}" 
                             class="img-fluid w-100 dream-city-image" 
                             alt="صورة شركة الهدف المباشر - {{ $index }}" 
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
                                <i class="fas fa-image fa-3x mb-2" style="text-shadow: 0 4px 10px rgba(0,0,0,0.5);"></i>
                                <p class="mb-0" style="text-shadow: 0 2px 8px rgba(0,0,0,0.5);">صورة #{{ $index }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- CTA Section -->
            <div class="row">
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">هل تبحث عن خدمات صحية متخصصة؟</h3>
                    <p class="mb-4">تواصل معنا اليوم لمعرفة المزيد عن بطاقة الخدمات الصحية وكيفية الوصول إلى الرعاية المتخصصة التي تحتاجها.</p>
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
