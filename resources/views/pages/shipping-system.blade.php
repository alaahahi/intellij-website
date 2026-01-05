@extends('layouts.app')

@section('title', 'نظام إدارة سفينة الشحن - إدارة نقل السيارات | IntelliJ App')

@section('description', 'نظام شامل لإدارة سفينة شحن واحدة لنقل السيارات. إدارة الرحلات، تتبع الشحنات، الفواتير والمدفوعات. حل متكامل لشركات النقل البحري - IntelliJ App')

@section('keywords', 'نظام إدارة سفينة, نقل سيارات, نظام شحن, إدارة رحلات, تتبع شحنات, نظام نقل بحري, إدارة سفينة, نظام شحن سيارات')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "نظام إدارة سفينة الشحن",
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
    "ratingCount": "95"
  },
  "description": "نظام شامل ومتكامل لإدارة سفينة شحن واحدة لنقل السيارات. يوفر إدارة كاملة للرحلات، تتبع الشحنات، إدارة العملاء والمدفوعات. حل متكامل لشركات النقل البحري",
  "keywords": "نظام إدارة سفينة, نقل سيارات, نظام شحن, إدارة رحلات, تتبع شحنات"
}
</script>
@endsection

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'نظام إدارة سفينة الشحن'])

    <main id="main-content" role="main">
    <!-- Shipping System Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Header Section -->
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h2 class="mb-1 text-primary h5">نظام إدارة سفينة الشحن</h2>
                <h1 class="display-5 mb-4">نظام شامل لإدارة سفينة شحن واحدة لنقل السيارات</h1>
                <p class="mb-0">نظام متكامل لإدارة سفينة شحن واحدة متخصصة في نقل السيارات. يوفر حلولاً احترافية لإدارة الرحلات، تتبع الشحنات، إدارة العملاء والمدفوعات، مع إمكانية التوسع المستقبلي.
                </p>
            </div>

            <!-- Hero Images Section -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <img src="{{ asset('img/shipping/1.png') }}" class="img-fluid w-100 rounded shadow-lg" alt="نظام إدارة سفينة الشحن - واجهة النظام" loading="lazy" style="object-fit: cover; height: 400px;">
                </div>
                <div class="col-md-6 wow fadeInRight" data-wow-delay="0.2s">
                    <img src="{{ asset('img/shipping/2.png') }}" class="img-fluid w-100 rounded shadow-lg" alt="نظام إدارة سفينة الشحن - لوحة التحكم" loading="lazy" style="object-fit: cover; height: 400px;">
                </div>
            </div>

            <!-- What Makes It Special -->
            <div class="row g-5 mb-5">
                <div class="col-12">
                    <div class="bg-light rounded p-5">
                        <h2 class="text-primary mb-4">ما الذي يميز نظام إدارة سفينة الشحن؟</h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-ship text-primary me-2"></i>إدارة الرحلات المتكاملة</h3>
                                <p>نظام شامل لإدارة رحلات السفينة الواحدة من بداية الرحلة حتى الوصول والتسليم. تتبع حالة كل رحلة، السعة المتاحة، وعدد السيارات المشحونة في الوقت الفعلي.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-car text-primary me-2"></i>تتبع السيارات والشحنات</h3>
                                <p>تتبع كامل لكل سيارة من لحظة الاستلام حتى التسليم. نظام تتبع متقدم يسمح للعملاء بالاستعلام عن حالة شحنتهم برقم الشحنة بدون الحاجة لتسجيل الدخول.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-users text-primary me-2"></i>إدارة العملاء الذكية</h3>
                                <p>نظام متكامل لإدارة العملاء (أفراد وتجار سيارات) مع حفظ بيانات الاتصال، نوع العميل، والملاحظات المهمة لتسهيل التواصل والمتابعة.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-chart-line text-primary me-2"></i>تقارير وإحصائيات شاملة</h3>
                                <p>تقارير مفصلة عن عدد السيارات في كل رحلة، الإيرادات، السيارات المتأخرة، والديون غير المسددة. يساعدك على اتخاذ قرارات مدروسة وتحسين الأداء.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-dollar-sign text-primary me-2"></i>إدارة مالية متقدمة</h3>
                                <p>نظام شامل لإدارة الفواتير والمدفوعات مع تتبع حالة الدفع، طريقة الدفع، وتاريخ الدفع. يساعدك على متابعة الإيرادات والديون بسهولة.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-shield-alt text-primary me-2"></i>منع تجاوز السعة</h3>
                                <p>نظام ذكي يمنع إضافة شحنات جديدة عند امتلاء السفينة. يحمي من الأخطاء ويضمن عدم تجاوز السعة القصوى للرحلة.</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('service') }}" class="btn btn-outline-primary me-2">استكشف جميع خدماتنا</a>
                            <a href="{{ route('contact') }}" class="btn btn-primary">تواصل معنا للحصول على عرض سعر</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Features Section -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h4 class="text-primary mb-4">المميزات الرئيسية</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة رحلات السفينة الواحدة</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة العملاء (أفراد وتجار)</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة السيارات والشحنات</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تتبع حالة الشحنات في الوقت الفعلي</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> نظام تتبع للعملاء (بدون تسجيل دخول)</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة الفواتير والمدفوعات</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> منع تجاوز السعة تلقائياً</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تقارير وإحصائيات شاملة</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> سجل تغييرات الحالة (Logs)</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة المستخدمين والأدوار</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> واجهة مستخدم بسيطة وسهلة</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> قابلية التوسع لإضافة سفن أخرى</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 mt-4">تواصل معنا</a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <h4 class="text-primary mb-4">الوحدات الأساسية</h4>
                    <div class="accordion" id="featuresAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#users">
                                    <i class="fas fa-users me-2"></i>المستخدمين والأدوار
                                </button>
                            </h2>
                            <div id="users" class="accordion-collapse collapse show" data-bs-parent="#featuresAccordion">
                                <div class="accordion-body">
                                    <ul class="mb-0">
                                        <li>Admin - إدارة كاملة للنظام</li>
                                        <li>موظف مكتب - تسجيل العملاء والشحنات</li>
                                        <li>محاسب - إدارة الفواتير والمدفوعات</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#customers">
                                    <i class="fas fa-user-friends me-2"></i>إدارة العملاء
                                </button>
                            </h2>
                            <div id="customers" class="accordion-collapse collapse" data-bs-parent="#featuresAccordion">
                                <div class="accordion-body">
                                    <ul class="mb-0">
                                        <li>تسجيل بيانات العملاء (الاسم، الهاتف، الدولة)</li>
                                        <li>تصنيف العملاء (فرد / تاجر)</li>
                                        <li>حفظ الملاحظات المهمة</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vehicles">
                                    <i class="fas fa-car me-2"></i>إدارة السيارات
                                </button>
                            </h2>
                            <div id="vehicles" class="accordion-collapse collapse" data-bs-parent="#featuresAccordion">
                                <div class="accordion-body">
                                    <ul class="mb-0">
                                        <li>تسجيل بيانات السيارة (رقم الشاصي، النوع، الموديل)</li>
                                        <li>سنة الصنع واللون</li>
                                        <li>رفع صور السيارة</li>
                                        <li>تتبع الحالة الحالية</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#trips">
                                    <i class="fas fa-ship me-2"></i>إدارة الرحلات
                                </button>
                            </h2>
                            <div id="trips" class="accordion-collapse collapse" data-bs-parent="#featuresAccordion">
                                <div class="accordion-body">
                                    <ul class="mb-0">
                                        <li>إنشاء رحلة جديدة (ميناء الانطلاق والوصول)</li>
                                        <li>تحديد السعة القصوى (عدد السيارات)</li>
                                        <li>تتبع عدد السيارات المشحونة</li>
                                        <li>حالات الرحلة (مفتوحة، أبحرت، وصلت، مغلقة)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shipments">
                                    <i class="fas fa-box me-2"></i>إدارة الشحنات
                                </button>
                            </h2>
                            <div id="shipments" class="accordion-collapse collapse" data-bs-parent="#featuresAccordion">
                                <div class="accordion-body">
                                    <ul class="mb-0">
                                        <li>ربط السيارة بالعميل والرحلة</li>
                                        <li>توليد رقم شحنة فريد</li>
                                        <li>تتبع حالة الشحنة</li>
                                        <li>تسجيل تاريخ الاستلام والتسليم</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tracking">
                                    <i class="fas fa-search-location me-2"></i>نظام التتبع
                                </button>
                            </h2>
                            <div id="tracking" class="accordion-collapse collapse" data-bs-parent="#featuresAccordion">
                                <div class="accordion-body">
                                    <ul class="mb-0">
                                        <li>استعلام عن حالة الشحنة برقم الشحنة</li>
                                        <li>عرض الحالة بدون الحاجة لتسجيل الدخول</li>
                                        <li>معلومات مفصلة عن حالة الشحنة</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Flow Section -->
            <div class="row g-5 mb-5">
                <div class="col-12">
                    <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                        <h2 class="mb-3">سير العمل</h2>
                        <p class="text-muted">من استلام السيارة حتى التسليم</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="text-center p-4 bg-light rounded">
                                <div class="mb-3">
                                    <i class="fas fa-hand-holding fa-3x text-primary"></i>
                                </div>
                                <h5 class="mb-3">استلام السيارة</h5>
                                <p class="text-muted small mb-0">استلام السيارة من العميل وتسجيل بياناتها الأساسية</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="text-center p-4 bg-light rounded">
                                <div class="mb-3">
                                    <i class="fas fa-clipboard-list fa-3x text-primary"></i>
                                </div>
                                <h5 class="mb-3">إدخال البيانات</h5>
                                <p class="text-muted small mb-0">تسجيل بيانات السيارة الكاملة (رقم الشاصي، النوع، الموديل)</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="text-center p-4 bg-light rounded">
                                <div class="mb-3">
                                    <i class="fas fa-ship fa-3x text-primary"></i>
                                </div>
                                <h5 class="mb-3">إضافة للرحلة</h5>
                                <p class="text-muted small mb-0">ربط السيارة برحلة السفينة مع التحقق من السعة المتاحة</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="text-center p-4 bg-light rounded">
                                <div class="mb-3">
                                    <i class="fas fa-anchor fa-3x text-primary"></i>
                                </div>
                                <h5 class="mb-3">تحميل وإبحار</h5>
                                <p class="text-muted small mb-0">تحميل السيارة على السفينة وبدء الرحلة</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                            <div class="text-center p-4 bg-light rounded">
                                <div class="mb-3">
                                    <i class="fas fa-map-marked-alt fa-3x text-primary"></i>
                                </div>
                                <h5 class="mb-3">الوصول</h5>
                                <p class="text-muted small mb-0">وصول السفينة إلى ميناء الوصول وتحديث حالة الرحلة</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="text-center p-4 bg-light rounded">
                                <div class="mb-3">
                                    <i class="fas fa-handshake fa-3x text-primary"></i>
                                </div>
                                <h5 class="mb-3">التسليم</h5>
                                <p class="text-muted small mb-0">تسليم السيارة للعميل وتحديث حالة الشحنة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Section -->
            <div class="row g-5 mb-5">
                <div class="col-12">
                    <div class="bg-primary text-white rounded p-5">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-8">
                                <h2 class="mb-3">تقارير وإحصائيات شاملة</h2>
                                <p class="mb-0">احصل على تقارير مفصلة تساعدك على اتخاذ قرارات مدروسة:</p>
                                <ul class="mt-3 mb-0">
                                    <li>عدد السيارات في كل رحلة</li>
                                    <li>الإيرادات لكل رحلة</li>
                                    <li>السيارات المتأخرة</li>
                                    <li>الديون غير المسددة</li>
                                </ul>
                            </div>
                            <div class="col-lg-4 text-center">
                                <i class="fas fa-chart-bar fa-5x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Educational Videos Section -->
            @include('components.videos-section', [
                'projectRoute' => 'shipping-system',
                'sectionTitle' => 'الفيديوهات التعليمية',
                'sectionDescription' => 'تعلم كيفية استخدام نظام إدارة سفينة الشحن من خلال سلسلة الفيديوهات التعليمية الشاملة'
            ])

            <!-- CTA Section -->
            <div class="row">
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">هل تبحث عن نظام لإدارة سفينة الشحن؟</h3>
                    <p class="mb-4">تواصل معنا اليوم لمعرفة المزيد عن نظام إدارة سفينة الشحن وكيف يمكنه مساعدتك في تحسين إدارة عملك</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 me-3">تواصل معنا</a>
                    <a href="{{ route('service') }}" class="btn btn-light rounded-pill py-3 px-5">عودة للخدمات</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Shipping System End -->
    </main>

    @include('components.footer')
@endsection

