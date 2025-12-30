@extends('layouts.app')

@section('title', 'نظام عقود بيع السيارات - التطبيق الذكي')

@section('description', 'نظام شامل ومتكامل لإدارة عقود بيع السيارات للمعارض. يوفر حلولاً احترافية لإدارة جميع عمليات البيع مع توقيع إلكتروني آمن ومزامنة تلقائية')

@section('keywords', 'نظام عقود, عقود بيع سيارات, معارض سيارات, معارض السيارات, إدارة عقود, توقيع إلكتروني, نظام معارض, اربيل, بغداد')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "نظام عقود بيع السيارات",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "Web",
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "USD"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "ratingCount": "120"
  },
  "description": "نظام شامل ومتكامل لإدارة عقود بيع السيارات للمعارض. يوفر حلولاً احترافية لإدارة جميع عمليات البيع مع توقيع إلكتروني آمن ومزامنة تلقائية. متوفر لمعارض السيارات في اربيل وبغداد",
  "keywords": "معارض السيارات, معارض سيارات, نظام عقود, اربيل, بغداد"
}
</script>
@endsection

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'نظام عقود بيع السيارات'])

    <!-- Contracts System Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Header Section -->
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="mb-1 text-primary">نظام عقود بيع السيارات</h4>
                <h1 class="display-5 mb-4">نظام عقود بيع السيارات</h1>
                <p class="mb-0">نظام شامل ومتكامل لإدارة عقود بيع السيارات للمعارض. يوفر حلولاً احترافية لإدارة جميع عمليات البيع مع توقيع إلكتروني آمن ومزامنة تلقائية. متوفر لمعارض السيارات في اربيل وبغداد.
                </p>
            </div>

            <!-- Main Features Section -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h4 class="text-primary mb-4">المميزات الرئيسية</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة شاملة للعقود الإلكترونية</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> توقيع إلكتروني آمن ومشفر</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تتبع حالة العقود في الوقت الفعلي</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تقارير مفصلة وإحصائيات</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> الوضع الليلي (Dark Mode)</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> العمل Offline بدون إنترنت</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> مزامنة تلقائية عند الاتصال بالإنترنت</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> نسخ احتياطية واسترجاع تلقائي</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> باركود مخصص لكل عقد</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> QR Code للتحقق من صحة العقد</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> التحقق من العقد لدى العميل عبر QR</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> <strong class="text-primary">جلب معلومات السيارات تلقائياً من الويب</strong></li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 mt-4">تواصل معنا</a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <img src="{{ asset('img/contracts-system/1.png') }}" class="img-fluid w-100 rounded shadow" alt="نظام عقود بيع السيارات" loading="lazy">
                </div>
            </div>

            <!-- Dashboard Overview Section -->
            <div class="row g-5 mb-5">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="text-center mb-5">لوحة التحكم الرئيسية</h3>
                    <p class="text-center mb-4">لوحة تحكم شاملة تعرض جميع العقود والإحصائيات في مكان واحد</p>
                    <img src="{{ asset('img/contracts-system/1.png') }}" class="img-fluid w-100 rounded shadow" alt="لوحة التحكم" loading="lazy">
                </div>
            </div>

            <!-- Advanced Features Section -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-moon fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">الوضع الليلي</h5>
                        <p>وضع ليلي مريح للعين مع إمكانية التبديل بين الوضع الفاتح والداكن</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-server fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">العمل Offline</h5>
                        <p>إمكانية العمل بدون إنترنت مع حفظ تلقائي للمعاملات</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-sync-alt fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">مزامنة تلقائية</h5>
                        <p>مزامنة تلقائية لجميع البيانات عند الاتصال بالإنترنت</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-database fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">نسخ احتياطية</h5>
                        <p>أخذ نسخ احتياطية تلقائية ويدوية مع إمكانية الاسترجاع السريع</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.9s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-file-signature fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">توقيع إلكتروني</h5>
                        <p>توقيع إلكتروني آمن ومشفر للعقود مع التحقق من الهوية</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.1s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-chart-line fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">تقارير وإحصائيات</h5>
                        <p>تقارير مفصلة وإحصائيات مرئية عن جميع العقود</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.3s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-barcode fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">باركود مخصص</h5>
                        <p>باركود فريد ومخصص لكل عقد لسهولة التتبع والتحقق</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.5s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-qrcode fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">QR Code للتحقق</h5>
                        <p>QR Code لكل عقد للتحقق السريع من صحة العقد عبر مسح الكود</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.7s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-mobile-alt fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">التحقق لدى العميل</h5>
                        <p>إمكانية التحقق من العقد لدى العميل عبر مسح QR Code بسهولة</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.9s">
                    <div class="feature-item text-center p-4 rounded position-relative" style="background: linear-gradient(135deg, rgba(102, 16, 242, 0.1) 0%, rgba(247, 71, 128, 0.1) 100%); border: 2px solid var(--bs-primary); transform: scale(1.05); box-shadow: 0 10px 30px rgba(102, 16, 242, 0.2);">
                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-2" style="font-size: 0.75rem;">
                            <i class="fas fa-star me-1"></i> مميز
                        </span>
                        <div class="mb-3">
                            <i class="fas fa-car fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3 text-primary fw-bold">جلب معلومات السيارات تلقائياً</h5>
                        <p>جلب معلومات السيارات (الاسم، الموديل، حجم المحرك) تلقائياً من الويب بمجرد إدخال رقم الشاصي</p>
                    </div>
                </div>
            </div>

            <!-- System Screenshots Section -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <h3 class="text-center mb-5">لقطات من النظام</h3>
                </div>
                
                <!-- Screenshot 1 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/2.png') }}" class="card-img-top" alt="إدارة العقود" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة العقود</h5>
                            <p class="card-text">واجهة شاملة لإدارة جميع أنواع العقود مع إمكانية البحث والفلترة</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 2 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/3.png') }}" class="card-img-top" alt="إنشاء عقد جديد" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إنشاء عقد جديد</h5>
                            <p class="card-text">إنشاء عقود جديدة بسهولة مع قوالب جاهزة</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 3 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/4.png') }}" class="card-img-top" alt="التوقيع الإلكتروني" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">التوقيع الإلكتروني</h5>
                            <p class="card-text">نظام توقيع إلكتروني آمن ومشفر للعقود</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 4 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/5.png') }}" class="card-img-top" alt="تتبع الحالة" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">تتبع حالة العقود</h5>
                            <p class="card-text">تتبع حالة العقود في الوقت الفعلي مع إشعارات</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 5 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.9s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/6.png') }}" class="card-img-top" alt="التقارير" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">التقارير والإحصائيات</h5>
                            <p class="card-text">تقارير مرئية وإحصائيات مفصلة عن جميع العقود</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 6 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1.1s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/7.png') }}" class="card-img-top" alt="الوضع الليلي" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">الوضع الليلي</h5>
                            <p class="card-text">وضع ليلي مريح للعين مع إمكانية التبديل السريع</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 7 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1.3s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/8.png') }}" class="card-img-top" alt="العمل Offline" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">العمل Offline</h5>
                            <p class="card-text">إمكانية العمل بدون إنترنت مع مزامنة تلقائية</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 8 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1.5s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/contracts-system/9.png') }}" class="card-img-top" alt="النسخ الاحتياطية" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">النسخ الاحتياطية</h5>
                            <p class="card-text">نظام نسخ احتياطية تلقائية مع إمكانية الاسترجاع</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="row g-5 mb-5">
                <div class="col-lg-12">
                    <div class="bg-light rounded p-5 wow fadeInUp" data-wow-delay="0.1s">
                        <h3 class="text-center mb-4">فوائد استخدام نظام عقود بيع السيارات</h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>توفير الوقت والجهد</h5>
                                        <p>أتمتة جميع عمليات إدارة العقود لتوفير الوقت والجهد</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>أمان عالي</h5>
                                        <p>توقيع إلكتروني آمن ومشفر مع حماية البيانات</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>عمل بدون إنترنت</h5>
                                        <p>إمكانية العمل Offline مع مزامنة تلقائية عند الاتصال</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>حماية البيانات</h5>
                                        <p>نسخ احتياطية تلقائية مع إمكانية الاسترجاع السريع</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>باركود وQR Code مخصص</h5>
                                        <p>باركود فريد وQR Code لكل عقد للتحقق السريع من صحة العقد</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>التحقق لدى العميل</h5>
                                        <p>العميل يمكنه التحقق من صحة العقد بسهولة عبر مسح QR Code</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="text-primary fw-bold">جلب معلومات السيارات تلقائياً</h5>
                                        <p>جلب معلومات السيارات (الاسم، الموديل، حجم المحرك) تلقائياً من الويب بمجرد إدخال رقم الشاصي</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Demo Request Section -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="bg-light rounded p-5 text-center wow fadeInUp" data-wow-delay="0.1s" style="background: linear-gradient(135deg, rgba(102, 16, 242, 0.05) 0%, rgba(247, 71, 128, 0.05) 100%) !important; border: 2px solid var(--bs-primary);">
                        <div class="mb-4">
                            <i class="fas fa-gift fa-4x text-primary mb-3"></i>
                        </div>
                        <h3 class="mb-4 text-primary fw-bold">جرب النظام مجاناً لمدة 30 يوم</h3>
                        <p class="mb-4 fs-5">احصل على نسخة تجريبية مجانية من نظام عقود بيع السيارات لمدة 30 يوم. جرب جميع المميزات بدون أي التزام.</p>
                        <div class="row g-3 justify-content-center mb-4">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check-circle text-success fa-2x me-2"></i>
                                    <span class="fs-6">تجربة كاملة لجميع المميزات</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check-circle text-success fa-2x me-2"></i>
                                    <span class="fs-6">دعم فني مجاني خلال الفترة التجريبية</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check-circle text-success fa-2x me-2"></i>
                                    <span class="fs-6">لا حاجة لبطاقة ائتمان</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}?demo=contracts-system" class="btn btn-primary btn-lg rounded-pill py-3 px-5" id="demoRequestBtn">
                            <i class="fas fa-download me-2"></i> طلب مجاني
                        </a>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="row">
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">هل أنت مستعد لتحسين إدارة عقودك؟</h3>
                    <p class="mb-4">تواصل معنا اليوم لمعرفة المزيد عن نظام عقود بيع السيارات وكيف يمكنه مساعدتك</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 me-3">تواصل معنا</a>
                    <a href="{{ route('service') }}" class="btn btn-light rounded-pill py-3 px-5">عودة للخدمات</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Contracts System End -->

    @include('components.footer')

    @push('scripts')
    <script>
        // حفظ معلومات طلب الديمو في localStorage عند الضغط على زر "طلب مجاني"
        document.addEventListener('DOMContentLoaded', function() {
            const demoRequestBtn = document.getElementById('demoRequestBtn');
            if (demoRequestBtn) {
                demoRequestBtn.addEventListener('click', function(e) {
                    // حفظ معلومات طلب الديمو
                    const demoRequest = {
                        source: 'contracts-system',
                        type: 'demo',
                        subject: 'طلب ديمو تجريبي - نظام عقود بيع السيارات',
                        message: 'أرغب في الحصول على نسخة تجريبية مجانية من نظام عقود بيع السيارات لمدة 30 يوم.',
                        project_type: 'نظام عقود بيع السيارات',
                        timestamp: new Date().toISOString()
                    };
                    localStorage.setItem('demoRequest', JSON.stringify(demoRequest));
                });
            }
        });
    </script>
    @endpush
@endsection
