@extends('layouts.app')

@section('title', 'IntelliJ App – برامج محاسبة وأنظمة إدارة معارض السيارات | حلول برمجية متكاملة')

@section('description', 'IntelliJ App تقدم حلول برمجية متطورة تشمل برنامج محاسبة ذكي ونظام إدارة معارض السيارات للشركات والمؤسسات. حلول موثوقة ومخصصة.')

@section('keywords', 'حلول تقنية, برمجيات, تطوير المواقع, أنظمة إلكترونية, برنامج محاسبة, نظام عقود, معارض سيارات, معارض السيارات, محاسبة, محاسبة شركات, تطوير تطبيقات, اربيل, بغداد')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "IntelliJ App",
  "alternateName": "التطبيق الذكي",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('img/logo.png') }}",
  "description": "IntelliJ App تقدم حلول برمجية متطورة تشمل برنامج محاسبة ذكي ونظام إدارة معارض السيارات للشركات والمؤسسات. حلول موثوقة ومخصصة.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "اربيل",
    "addressLocality": "اربيل",
    "postalCode": "40001",
    "addressRegion": "اربيل",
    "addressCountry": "IQ"
  },
  "telephone": "+9647511077812",
  "email": "info@intellij-app.com",
  "sameAs": [],
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+9647511077812",
    "contactType": "customer service",
    "areaServed": "IQ",
    "availableLanguage": ["Arabic", "ar"]
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "التطبيق الذكي",
  "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/') }}?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
@endsection

@section('content')
    @include('components.header', ['showHero' => true, 'headerClass' => 'header position-relative overflow-hidden p-0', 'navbarClass' => 'fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-0'])

    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5" style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="RotateMoveLeft" style="min-height: 400px; aspect-ratio: 1/1; position: relative;">
                        <img src="{{ asset('img/account/2.png') }}" class="img-fluid w-100" alt="برنامج محاسب ذكي مع مخزن - حلول تقنية متطورة" loading="lazy" width="500" height="500" style="object-fit: contain; display: block;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="mb-1 text-primary">من نحن</h4>
                    <h2 class="display-5 mb-4">شركة تقنية متخصصة في تطوير الحلول البرمجية</h2>
                    <p class="mb-4">نحن فريق من المطورين المحترفين متخصصون في تطوير الحلول البرمجية والأنظمة الإلكترونية المبتكرة. نقدم خدمات شاملة من التصميم إلى التطوير والبرمجة والصيانة، مع التركيز على الجودة والابتكار ورضا العملاء. نخدم عملاءنا في اربيل وبغداد وجميع أنحاء العراق.
                    </p>
                    <a href="{{ route('about') }}" class="btn btn-primary rounded-pill py-3 px-5">المزيد عنا</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="mb-1 text-primary">خدماتنا</h4>
                <h2 class="display-5 mb-4">ماذا يمكننا أن نقدم لك</h2>
                <p class="mb-0">نقدم مجموعة شاملة من الخدمات التقنية والبرمجية التي تغطي جميع احتياجاتك التقنية. من تطوير المواقع والتطبيقات إلى الأنظمة الإلكترونية المتخصصة، نحن هنا لتحويل رؤيتك إلى واقع.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- نظام عقود بيع السيارات -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-file-contract fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h3 class="mb-4">نظام عقود بيع السيارات</h3>
                            <p class="mb-4">نظام شامل لإدارة عقود بيع السيارات للمعارض مع توقيع إلكتروني آمن وجلب معلومات السيارات تلقائياً من الإنترنت.
                            </p>
                            <a href="{{ route('contracts-system') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">للمزيد عن نظام عقود بيع السيارات اضغط هنا</a>
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
                            <h3 class="mb-4 text-primary fw-bold">برنامج المحاسب الذكي</h3>
                            <p class="mb-4">نظام متكامل للمحاسبة وإدارة المستودعات والمشتريات. ما يميزه: إدارة مالية شاملة، تقارير مفصلة، وإدارة مخزون ذكية.
                            </p>
                            <a href="{{ route('accounting-system') }}" class="btn btn-primary rounded-pill text-white py-2 px-4">للمزيد عن برنامج المحاسب الذكي اضغط هنا</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Feature Start -->
    <div class="container-fluid feature overflow-hidden py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">المميزات</h4>
                <h1 class="display-5 mb-4">مميزات مهمة لحلولنا التقنية</h1>
                <p class="mb-0">نقدم حلولاً تقنية متطورة تتميز بالجودة العالية والأداء المتميز والأمان القوي. نضمن لك تجربة مستخدم استثنائية مع دعم فني مستمر.
                </p>
            </div>
            <div class="row g-4 justify-content-center text-center mb-5">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-shield-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <h4 class="h4">الأمان والحماية</h4>
                            <p class="mt-4 mb-0">أنظمة أمان متقدمة لحماية بياناتك ومعلوماتك الحساسة
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-tachometer-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <h4 class="h4">أداء عالي</h4>
                            <p class="mt-4 mb-0">أداء فائق السرعة وتجربة مستخدم سلسة وسريعة
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-headset fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <h4 class="h4">دعم فني مستمر</h4>
                            <p class="mt-4 mb-0">فريق دعم فني محترف متاح لمساعدتك في أي وقت
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-sync-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <h4 class="h4">تحديثات مستمرة</h4>
                            <p class="mt-4 mb-0">تحديثات وتحسينات مستمرة لإضافة المزيد من المميزات
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="my-3">
                        <a href="{{ route('feature') }}" class="btn btn-primary d-inline rounded-pill px-5 py-3">المزيد من المميزات</a>
                    </div>
                </div>
            </div>
            <div class="row g-5 pt-5" style="margin-top: 6rem;">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="feature-img RotateMoveLeft h-100" style="object-fit: cover;">
                        <img src="{{ asset('img/account/3.png') }}" class="img-fluid w-100 h-100" alt="إحصائيات برامج محاسبة وأنظمة إدارة - IntelliJ App" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.1s">
                    <h4 class="text-primary">الإحصائيات</h4>
                    <h1 class="display-5 mb-4">إنجازاتنا تتحدث عنا</h1>
                    <p class="mb-4">نفخر بثقة عملائنا وإنجازاتنا في مجال التطوير البرمجي. نسعى دائماً لتقديم أفضل الحلول التقنية التي تساهم في نجاح أعمال عملائنا.
                    </p>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="d-flex">
                                <i class="fas fa-project-diagram fa-4x text-secondary"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h2 class="mb-0 fw-bold">150+</h2>
                                    <small class="text-dark">مشروع منجز</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex">
                                <i class="fas fa-users fa-4x text-secondary"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h2 class="mb-0 fw-bold">120+</h2>
                                    <small class="text-dark">عميل راضٍ</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <a href="{{ route('about') }}" class="btn btn-primary rounded-pill py-3 px-5">المزيد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- FAQ Start -->
    <div class="container-fluid FAQ bg-light overflow-hidden py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                   <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseTOne">
                                    لماذا تختار خدماتنا؟
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>حلول تقنية متطورة واحترافية</h5>
                                    <p>نقدم حلولاً تقنية متخصصة مصممة خصيصاً لتلبية احتياجاتك. فريقنا المحترف يضمن جودة عالية وأداء متميز في كل مشروع نعمل عليه.</p>
                                    <p>نستخدم أحدث التقنيات والمعايير العالمية في التطوير لضمان الحصول على أفضل النتائج.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    هل هناك رسوم مخفية؟
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>شفافية كاملة في الأسعار</h5>
                                    <p>لا توجد رسوم مخفية. نقدم أسعاراً واضحة ومباشرة لجميع خدماتنا. ستحصل على عرض سعر شامل يغطي جميع متطلبات المشروع.</p>
                                    <p>يمكنك التواصل معنا للحصول على عرض أسعار مخصص لمشروعك.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    ما هي مدة تنفيذ المشروع؟
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>تسليم في الوقت المحدد</h5>
                                    <p>مدة التنفيذ تعتمد على حجم وتعقيد المشروع. نحدد جدول زمني واضح منذ البداية ونسلم المشروع في الوقت المتفق عليه.</p>
                                    <p>نقوم بتحديثك بانتظام حول التقدم في المشروع لضمان الشفافية والثقة.</p>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="FAQ-img RotateMoveRight rounded">
                        <img src="{{ asset('img/account/4.png') }}" class="img-fluid w-100" alt="أسئلة شائعة عن برامج المحاسبة وأنظمة المعارض" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ End -->

    <!-- Pricing Start -->
    <div class="container-fluid price py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">الأسعار</h4>
                <h1 class="display-5 mb-4">باقات تصميم المواقع الإلكترونية</h1>
                <p class="mb-0">اختر الباقة المناسبة لموقعك. جميع الباقات تشمل دومين مجاني وسنة استضافة مجانية.
                </p>
            </div>
            <div class="row g-5 justify-content-center">
                <!-- Package 1: $100 -->
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="price-item bg-light rounded text-center h-100">
                        <div class="text-center text-dark border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 180px;">
                            <p class="fs-2 fw-bold mb-2">الباقة الأساسية</p>
                            <div class="d-flex justify-content-center align-items-baseline">
                                <strong class="fs-4">$</strong>
                                <span class="display-4 fw-bold">100</span>
                            </div>
                            <p class="text-muted mb-0 mt-2">للموقع الواحد</p>
                        </div>
                        <div class="text-start p-5">
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تصميم موقع احترافي متجاوب</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> حتى 5 صفحات</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تصميم متجاوب لجميع الأجهزة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> دومين مجاني لمدة سنة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> استضافة مجانية لمدة سنة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> شهادة SSL مجانية</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> دعم فني لمدة شهر</p>
                            <p class="mb-4"><i class="fas fa-check text-success me-2"></i> تسليم خلال 7-10 أيام</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-2 px-5 w-100">اطلب الآن</a>
                        </div>
                    </div>
                </div>

                <!-- Package 2: $400 -->
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="price-item bg-light rounded text-center h-100 position-relative" style="border: 2px solid var(--bs-primary); transform: scale(1.05); box-shadow: 0 10px 30px rgba(102, 16, 242, 0.2);">
                        <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2" style="font-size: 0.75rem;">
                            <i class="fas fa-star me-1"></i> الأكثر طلباً
                        </span>
                        <div class="text-center text-primary border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 180px;">
                            <p class="fs-2 fw-bold mb-2">الباقة المتقدمة</p>
                            <div class="d-flex justify-content-center align-items-baseline">
                                <strong class="fs-4">$</strong>
                                <span class="display-4 fw-bold">400</span>
                            </div>
                            <p class="text-muted mb-0 mt-2">للموقع الواحد</p>
                        </div>
                        <div class="text-start p-5">
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تصميم موقع احترافي متقدم</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> حتى 15 صفحة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تصميم متجاوب لجميع الأجهزة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> نظام إدارة المحتوى (CMS)</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> دومين مجاني لمدة سنة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> استضافة مجانية لمدة سنة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> شهادة SSL مجانية</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> نماذج اتصال متقدمة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تكامل مع وسائل التواصل الاجتماعي</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> دعم فني لمدة 3 أشهر</p>
                            <p class="mb-4"><i class="fas fa-check text-success me-2"></i> تسليم خلال 14-20 يوم</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-2 px-5 w-100">اطلب الآن</a>
                        </div>
                    </div>
                </div>

                <!-- Package 3: $600 -->
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="price-item bg-light rounded text-center h-100">
                        <div class="text-center text-dark border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 180px;">
                            <p class="fs-2 fw-bold mb-2">الباقة المميزة</p>
                            <div class="d-flex justify-content-center align-items-baseline">
                                <strong class="fs-4">$</strong>
                                <span class="display-4 fw-bold">600</span>
                            </div>
                            <p class="text-muted mb-0 mt-2">للموقع الواحد</p>
                        </div>
                        <div class="text-start p-5">
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تصميم موقع احترافي متكامل</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> صفحات غير محدودة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تصميم متجاوب لجميع الأجهزة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> نظام إدارة محتوى متقدم</p>
                             <p class="mb-3"><i class="fas fa-check text-success me-2"></i> دومين مجاني لمدة سنة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> استضافة مجانية لمدة سنة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> شهادة SSL مجانية</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> لوحة تحكم متقدمة</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> تكامل مع أنظمة الدفع</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> SEO محسّن</p>
                            <p class="mb-3"><i class="fas fa-check text-success me-2"></i> دعم فني لمدة 6 أشهر</p>
                            <p class="mb-4"><i class="fas fa-check text-success me-2"></i> تسليم خلال 25-30 يوم</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-2 px-5 w-100">اطلب الآن</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">المشاريع</h4>
                <h2 class="display-5 mb-4">مشاريعنا المتميزة</h2>
                <p class="mb-0">استعرض بعضاً من المشاريع الناجحة التي قمنا بتطويرها لعملائنا. كل مشروع يمثل تحدياً جديداً وفرصة لتقديم قيمة حقيقية.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- نظام عقود بيع السيارات -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/contracts-system/1.png') }}" class="img-fluid w-100" alt="نظام عقود بيع السيارات لمعارض السيارات" loading="lazy">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">نظام عقود بيع السيارات</h5>
                            <p class="mb-4">نظام شامل لإدارة عقود بيع السيارات للمعارض مع توقيع إلكتروني آمن. <a href="{{ route('contracts-system') }}" class="text-primary text-decoration-none">للمزيد عن نظام عقود بيع السيارات اضغط هنا</a></p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('contracts-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                
                <!-- برنامج المحاسب الذكي -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/account/1.png') }}" class="img-fluid w-100" alt="برنامج محاسب ذكي مع مخزن - نظام محاسبة متكامل" loading="lazy">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">برنامج المحاسب الذكي</h5>
                            <p class="mb-4">نظام متكامل للمحاسبة وإدارة المستودعات والمشتريات. <a href="{{ route('accounting-system') }}" class="text-primary">للمزيد عن برنامج المحاسب الذكي اضغط هنا</a></p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('accounting-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                
                <!-- نظام عقود بيع السيارات - صورة أخرى -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/contracts-system/2.png') }}" class="img-fluid w-100" alt="إدارة عقود بيع السيارات للمعارض" loading="lazy">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">إدارة العقود</h5>
                            <p class="mb-4">واجهة شاملة لإدارة جميع أنواع العقود مع إمكانية البحث والفلترة</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('contracts-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                
                <!-- برنامج المحاسب الذكي - صورة أخرى -->
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/account/2.png') }}" class="img-fluid w-100" alt="لوحة تحكم برنامج محاسبة مع تقارير مالية" loading="lazy">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"><i class="fa fa-heart"></i> مشروع</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">لوحة التحكم</h5>
                            <p class="mb-4">لوحة تحكم شاملة تعرض جميع البيانات والإحصائيات</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('accounting-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Clients Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">زبائننا</h4>
                <h1 class="display-5 mb-4">عملاؤنا المميزون</h1>
                <p class="mb-0">نفخر بثقة عملائنا وشراكاتنا الناجحة مع الشركات والمؤسسات الرائدة في مختلف المجالات.
                </p>
            </div>
            <div class="row g-4 justify-content-center align-items-center">
                <!-- شركة سلام جلال ايوب اربيل -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="client-item text-center p-4 bg-white rounded shadow-sm h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 200px; transition: all 0.3s ease;">
                        <img src="{{ asset('img/clients/salam.jpg') }}" class="img-fluid mb-3" alt="شركة سلام جلال ايوب اربيل" style="max-height: 120px; object-fit: contain;" loading="lazy">
                        <h5 class="mb-2">شركة سلام جلال ايوب</h5>
                        <p class="text-muted mb-0 small">اربيل</p>
                    </div>
                </div>
                
                <!-- معرض المعتز كركوك -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="client-item text-center p-4 bg-white rounded shadow-sm h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 200px; transition: all 0.3s ease;">
                        <img src="{{ asset('img/clients/almotiz.jpg') }}" class="img-fluid mb-3" alt="معرض المعتز كركوك" style="max-height: 120px; object-fit: contain;" loading="lazy">
                        <h5 class="mb-2">معرض المعتز</h5>
                        <p class="text-muted mb-0 small">كركوك</p>
                    </div>
                </div>
                
                <!-- شركة نور بصرة اربيل -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="client-item text-center p-4 bg-white rounded shadow-sm h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 200px; transition: all 0.3s ease;">
                        <img src="{{ asset('img/clients/nojom.jpg') }}" class="img-fluid mb-3" alt="شركة نور بصرة اربيل" style="max-height: 120px; object-fit: contain;" loading="lazy">
                        <h5 class="mb-2">شركة نور بصرة</h5>
                        <p class="text-muted mb-0 small">اربيل</p>
                    </div>
                </div>
                
                <!-- شركة الهدف المباشر بغداد -->
                <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="client-item text-center p-4 bg-white rounded shadow-sm h-100 d-flex flex-column align-items-center justify-content-center" style="min-height: 200px; transition: all 0.3s ease;">
                        <img src="{{ asset('img/clients/logo.jpg') }}" class="img-fluid mb-3" alt="شركة الهدف المباشر بغداد" style="max-height: 120px; object-fit: contain;" loading="lazy">
                        <h5 class="mb-2">شركة الهدف المباشر</h5>
                        <p class="text-muted mb-0 small">بغداد</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Clients End -->

    @include('components.footer')
@endsection
