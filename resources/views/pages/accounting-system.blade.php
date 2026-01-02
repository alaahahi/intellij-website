@extends('layouts.app')

@section('title', 'برنامج المحاسب الذكي - نظام محاسبة متكامل | IntelliJ App')

@section('description', 'برنامج محاسبة شامل لإدارة العمليات المالية والمحاسبية والمستودعات. مناسب لشركات المحاسبة في اربيل وبغداد - IntelliJ App')

@section('keywords', 'برنامج محاسبة, نظام محاسبة, محاسبة, محاسبة شركات, إدارة مستودعات, إدارة مخزون, برنامج محاسب, نظام مالي, اربيل, بغداد')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "برنامج المحاسب الذكي",
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
    "ratingCount": "150"
  },
  "description": "نظام متكامل للمحاسبة وإدارة المستودعات والمشتريات. نظام شامل لإدارة جميع العمليات المالية والمحاسبية مع إدارة المستودعات والمخزون. مناسب لشركات المحاسبة في اربيل وبغداد",
  "keywords": "محاسبة, محاسبة شركات, برنامج محاسبة, نظام محاسبة, اربيل, بغداد"
}
</script>
@endsection

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'برنامج المحاسب الذكي'])

    <main id="main-content" role="main">
    <!-- Accounting System Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Header Section -->
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h2 class="mb-1 text-primary h5">برنامج المحاسب الذكي</h2>
                <h1 class="display-5 mb-4">نظام متكامل للمحاسبة وإدارة المستودعات والمشتريات</h1>
                <p class="mb-0">نظام شامل ومتكامل لإدارة جميع العمليات المالية والمحاسبية، إدارة المستودعات والمخزون، وإدارة المشتريات والمبيعات. يوفر حلولاً احترافية لتحسين إدارة أعمالك. مناسب لشركات المحاسبة ومكاتب المحاسبة في اربيل وبغداد.
                </p>
            </div>

            <!-- What Makes It Special -->
            <div class="row g-5 mb-5">
                <div class="col-12">
                    <div class="bg-light rounded p-5">
                        <h2 class="text-primary mb-4">ما الذي يميز برنامج المحاسب الذكي؟</h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-check-circle text-primary me-2"></i>إدارة مالية شاملة</h3>
                                <p>نظام محاسبة متكامل يدير جميع العمليات المالية من الفواتير والمدفوعات إلى التقارير المالية التفصيلية. يساعدك على تتبع جميع المعاملات المالية بسهولة ودقة.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-check-circle text-primary me-2"></i>إدارة مخزون ذكية</h3>
                                <p>نظام متقدم لإدارة المستودعات والمخزون يتتبع حركة البضائع تلقائياً، ينبهك عند نفاد المخزون، ويوفر تقارير مفصلة عن حالة المخزون في الوقت الفعلي.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-check-circle text-primary me-2"></i>تقارير مالية مفصلة</h3>
                                <p>تقارير شاملة تغطي جميع جوانب عملك المالي: المبيعات، المشتريات، الأرباح، الخسائر، والكثير من التقارير الأخرى التي تساعدك في اتخاذ قرارات مدروسة.</p>
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 mb-3"><i class="fas fa-check-circle text-primary me-2"></i>مناسب لشركات المحاسبة</h3>
                                <p>مصمم خصيصاً لشركات المحاسبة ومكاتب المحاسبة في اربيل وبغداد. يدعم العمل مع عدة عملاء، إدارة حسابات متعددة، وتقارير مخصصة لكل عميل.</p>
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
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة محاسبية شاملة ومتكاملة</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة المستودعات والمخزون</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة المشتريات والمبيعات</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة الفواتير والمدفوعات</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة الزبائن والموردين</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تقارير مالية مفصلة وإحصائيات</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> نظام إدارة الأدوار والصلاحيات</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> الوضع الليلي (Dark Mode)</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> العمل Offline بدون إنترنت</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> مزامنة تلقائية عند الاتصال بالإنترنت</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> نسخ احتياطية واسترجاع تلقائي</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تغيير اللغة (متعدد اللغات)</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 mt-4">تواصل معنا</a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <img src="{{ asset('img/account/1.png') }}" class="img-fluid w-100 rounded shadow" alt="برنامج المحاسب الذكي" loading="lazy">
                </div>
            </div>

            <!-- Dashboard Overview Section -->
            <div class="row g-5 mb-5">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="text-center mb-5">لوحة التحكم الرئيسية</h3>
                    <p class="text-center mb-4">لوحة تحكم شاملة تعرض جميع المؤشرات المهمة والإحصائيات في مكان واحد</p>
                    <img src="{{ asset('img/account/1.png') }}" class="img-fluid w-100 rounded shadow" alt="لوحة التحكم" loading="lazy">
                </div>
            </div>

            <!-- Features Grid Section -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-file-invoice fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">إدارة الفواتير</h5>
                        <p>إدارة شاملة للفواتير المعلقة والمدفوعة مع تتبع الحالات</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-boxes fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">إدارة المستودعات</h5>
                        <p>تتبع المخزون وإدارة المستودعات مع تنبيهات المخزون المنخفض</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">إدارة المشتريات</h5>
                        <p>إدارة عمليات الشراء من الموردين مع تتبع الطلبات</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">إدارة الزبائن والموردين</h5>
                        <p>قاعدة بيانات شاملة للعملاء والموردين مع سجل المعاملات</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.9s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-chart-bar fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">التقارير والإحصائيات</h5>
                        <p>تقارير مالية مفصلة وإحصائيات مرئية لاتخاذ القرارات</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.1s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">إدارة الصلاحيات</h5>
                        <p>نظام متقدم لإدارة الأدوار والصلاحيات للمستخدمين</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.3s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-moon fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">الوضع الليلي</h5>
                        <p>وضع ليلي مريح للعين مع إمكانية التبديل بين الوضع الفاتح والداكن</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.5s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-server fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">العمل Offline</h5>
                        <p>إمكانية العمل بدون إنترنت مع حفظ تلقائي للمعاملات</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.7s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-sync-alt fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">مزامنة تلقائية</h5>
                        <p>مزامنة تلقائية لجميع البيانات عند الاتصال بالإنترنت</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="1.9s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-database fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">نسخ احتياطية</h5>
                        <p>أخذ نسخ احتياطية تلقائية ويدوية مع إمكانية الاسترجاع السريع</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="2.1s">
                    <div class="feature-item text-center p-4 bg-light rounded">
                        <div class="mb-3">
                            <i class="fas fa-language fa-3x text-primary"></i>
                        </div>
                        <h5 class="mb-3">تغيير اللغة</h5>
                        <p>دعم متعدد اللغات مع إمكانية التبديل بين اللغات بسهولة</p>
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
                        <img src="{{ asset('img/account/2.png') }}" class="card-img-top" alt="إدارة الفواتير" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة الفواتير</h5>
                            <p class="card-text">واجهة شاملة لإدارة جميع أنواع الفواتير مع إمكانية التتبع والفلترة</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 2 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/3.png') }}" class="card-img-top" alt="إدارة المنتجات" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة المنتجات</h5>
                            <p class="card-text">إدارة كاملة للمنتجات مع التصنيفات والمخزون والأسعار</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 3 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/4.png') }}" class="card-img-top" alt="توليد الباركود" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">توليد الباركود</h5>
                            <p class="card-text">نظام متقدم لتوليد وإدارة الباركود للمنتجات</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 4 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/5.png') }}" class="card-img-top" alt="التصنيفات" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة التصنيفات</h5>
                            <p class="card-text">تنظيم المنتجات في تصنيفات هرمية سهلة الإدارة</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 5 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.9s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/6.png') }}" class="card-img-top" alt="الصندوق" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة الصندوق</h5>
                            <p class="card-text">تتبع جميع المعاملات المالية والمدفوعات في الصندوق</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 6 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1.1s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/7.png') }}" class="card-img-top" alt="إدارة الزبائن" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة الزبائن</h5>
                            <p class="card-text">قاعدة بيانات شاملة للعملاء مع سجل المعاملات</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 7 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1.3s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/8.png') }}" class="card-img-top" alt="إدارة الموردين" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة الموردين</h5>
                            <p class="card-text">إدارة كاملة للموردين مع تتبع المشتريات والمدفوعات</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 8 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1.5s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/9.png') }}" class="card-img-top" alt="إدارة المستخدمين" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إدارة المستخدمين</h5>
                            <p class="card-text">إدارة المستخدمين مع نظام الصلاحيات والأدوار</p>
                        </div>
                    </div>
                </div>

                <!-- Screenshot 9 -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="1.7s">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('img/account/10.png') }}" class="card-img-top" alt="إحصائيات المبيعات" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">إحصائيات المبيعات</h5>
                            <p class="card-text">تقارير مرئية وإحصائيات مفصلة عن المبيعات والأداء</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="row g-5 mb-5">
                <div class="col-lg-12">
                    <div class="bg-light rounded p-5 wow fadeInUp" data-wow-delay="0.1s">
                        <h3 class="text-center mb-4">فوائد استخدام برنامج المحاسب الذكي</h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>توفير الوقت والجهد</h5>
                                        <p>أتمتة جميع العمليات المحاسبية والإدارية لتوفير الوقت والجهد</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>دقة في البيانات</h5>
                                        <p>تقليل الأخطاء البشرية وضمان دقة البيانات المالية</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>قرارات مدروسة</h5>
                                        <p>تقارير وإحصائيات مفصلة لاتخاذ قرارات مدروسة</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5>إدارة محسّنة</h5>
                                        <p>إدارة أفضل للمخزون والمشتريات والمبيعات</p>
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
                                        <h5>متعدد اللغات</h5>
                                        <p>دعم متعدد اللغات مع إمكانية التبديل بسهولة</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Educational Videos Section -->
            @php
                // قائمة الفيديوهات التعليمية - يمكن إضافة أو تعديل الفيديوهات هنا
                $videos = [
                    [
                        'title' => 'مقدمة عن البرنامج',
                        'description' => 'تعرف على برنامج المحاسب الذكي والمميزات الأساسية',
                        'video_url' => null, // مثال: 'https://www.youtube.com/watch?v=VIDEO_ID' أو 'https://youtu.be/VIDEO_ID'
                        'thumbnail' => null, // اختياري: رابط صورة مصغرة مخصصة
                        'duration' => null, // اختياري: مدة الفيديو (مثال: '10:30')
                    ],
                    [
                        'title' => 'إدارة الفواتير',
                        'description' => 'تعلم كيفية إنشاء وإدارة الفواتير بسهولة',
                        'video_url' => null,
                        'thumbnail' => null,
                        'duration' => null,
                    ],
                    [
                        'title' => 'إدارة المستودعات',
                        'description' => 'كيفية إدارة المخزون والمستودعات بشكل فعال',
                        'video_url' => null,
                        'thumbnail' => null,
                        'duration' => null,
                    ],
                    [
                        'title' => 'إدارة المشتريات',
                        'description' => 'تعلم كيفية إدارة عمليات الشراء من الموردين',
                        'video_url' => null,
                        'thumbnail' => null,
                        'duration' => null,
                    ],
                    [
                        'title' => 'التقارير والإحصائيات',
                        'description' => 'كيفية استخدام التقارير المالية والإحصائيات',
                        'video_url' => null,
                        'thumbnail' => null,
                        'duration' => null,
                    ],
                    [
                        'title' => 'إدارة الصلاحيات',
                        'description' => 'تعلم كيفية إدارة المستخدمين والأدوار والصلاحيات',
                        'video_url' => null,
                        'thumbnail' => null,
                        'duration' => null,
                    ],
                ];
                
                // Helper function لاستخراج video ID من YouTube URL
                function getYouTubeVideoId($url) {
                    if (empty($url)) return null;
                    
                    // YouTube URL patterns
                    $patterns = [
                        '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',
                        '/youtu\.be\/([a-zA-Z0-9_-]+)/',
                        '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/',
                    ];
                    
                    foreach ($patterns as $pattern) {
                        if (preg_match($pattern, $url, $matches)) {
                            return $matches[1];
                        }
                    }
                    
                    return null;
                }
                
                // Helper function لاستخراج video ID من Vimeo URL
                function getVimeoVideoId($url) {
                    if (empty($url)) return null;
                    
                    if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
                        return $matches[1];
                    }
                    
                    return null;
                }
                
                // Helper function لتحديد نوع الفيديو
                function getVideoType($url) {
                    if (empty($url)) return null;
                    
                    if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                        return 'youtube';
                    } elseif (strpos($url, 'vimeo.com') !== false) {
                        return 'vimeo';
                    }
                    
                    return null;
                }
                
                // Helper function للحصول على thumbnail من YouTube
                function getYouTubeThumbnail($videoId) {
                    if (empty($videoId)) return null;
                    return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                }
            @endphp
            
            <div class="row g-5 mb-5">
                <div class="col-12">
                    <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                        <h3 class="mb-3">الفيديوهات التعليمية</h3>
                        <p class="text-muted">تعلم كيفية استخدام برنامج المحاسب الذكي من خلال سلسلة الفيديوهات التعليمية الشاملة</p>
                    </div>
                    
                    <div class="row g-4">
                        @foreach($videos as $index => $video)
                            @php
                                $videoId = null;
                                $videoType = null;
                                $embedUrl = null;
                                $thumbnailUrl = $video['thumbnail'];
                                
                                if (!empty($video['video_url'])) {
                                    $videoType = getVideoType($video['video_url']);
                                    
                                    if ($videoType === 'youtube') {
                                        $videoId = getYouTubeVideoId($video['video_url']);
                                        if ($videoId) {
                                            $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                            if (empty($thumbnailUrl)) {
                                                $thumbnailUrl = getYouTubeThumbnail($videoId);
                                            }
                                        }
                                    } elseif ($videoType === 'vimeo') {
                                        $videoId = getVimeoVideoId($video['video_url']);
                                        if ($videoId) {
                                            $embedUrl = "https://player.vimeo.com/video/{$videoId}";
                                        }
                                    }
                                }
                                
                                $hasVideo = !empty($embedUrl);
                                $delay = 0.1 + ($index * 0.2);
                            @endphp
                            
                            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                                <div class="card border-0 shadow-sm h-100 video-card">
                                    <div class="position-relative" style="padding-top: 56.25%; overflow: hidden; background: linear-gradient(135deg, rgba(102, 16, 242, 0.1) 0%, rgba(247, 71, 128, 0.1) 100%);">
                                        @if($hasVideo && $thumbnailUrl)
                                            <img src="{{ $thumbnailUrl }}" alt="{{ $video['title'] }}" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;">
                                        @endif
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3); cursor: pointer;" 
                                             @if($hasVideo) data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('{{ $embedUrl }}', '{{ $videoType }}')" @endif>
                                            <div class="text-center">
                                                <i class="fas fa-play-circle text-white" style="font-size: 4rem; opacity: 0.9; text-shadow: 0 2px 10px rgba(0,0,0,0.5);"></i>
                                                @if($video['duration'])
                                                    <div class="mt-2">
                                                        <span class="badge bg-dark bg-opacity-75">{{ $video['duration'] }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video['title'] }}</h5>
                                        <p class="card-text text-muted small">{{ $video['description'] }}</p>
                                        @if(!$hasVideo)
                                            <span class="badge bg-secondary">قريباً</span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>متاح
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if(collect($videos)->where('video_url', '!=', null)->isEmpty())
                        <div class="text-center mt-4 wow fadeInUp" data-wow-delay="1.3s">
                            <p class="text-muted mb-3">سيتم إضافة الفيديوهات التعليمية قريباً</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill py-2 px-4">
                                <i class="fas fa-bell me-2"></i>إشعارني عند إضافة الفيديوهات
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Video Modal -->
            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="ratio ratio-16x9">
                                <iframe id="videoFrame" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                function loadVideo(embedUrl, videoType) {
                    const iframe = document.getElementById('videoFrame');
                    if (videoType === 'youtube') {
                        iframe.src = embedUrl + '?autoplay=1&rel=0&modestbranding=1&showinfo=0';
                    } else if (videoType === 'vimeo') {
                        iframe.src = embedUrl + '?autoplay=1';
                    } else {
                        iframe.src = embedUrl;
                    }
                }
                
                // إيقاف الفيديو عند إغلاق الـ modal
                document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
                    document.getElementById('videoFrame').src = '';
                });
            </script>

            <!-- CTA Section -->
            <div class="row">
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-4">هل أنت مستعد لتحسين إدارة أعمالك؟</h3>
                    <p class="mb-4">تواصل معنا اليوم لمعرفة المزيد عن برنامج المحاسب الذكي وكيف يمكنه مساعدتك</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5 me-3">تواصل معنا</a>
                    <a href="{{ route('service') }}" class="btn btn-light rounded-pill py-3 px-5">عودة للخدمات</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Accounting System End -->
    </main>

    @include('components.footer')
@endsection

