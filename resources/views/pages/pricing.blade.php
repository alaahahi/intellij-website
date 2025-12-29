@extends('layouts.app')

@section('title', 'الأسعار - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'الأسعار'])

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
                    <div class="price-item bg-light rounded text-center h-100 position-relative" style="border: 2px solid var(--bs-primary); transform: scale(1.05);">
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

            <!-- Additional Info -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="bg-light rounded p-5 text-center wow fadeInUp" data-wow-delay="0.7s">
                        <h4 class="mb-4">ملاحظات مهمة</h4>
                        <div class="row g-4 text-start">
                            <div class="col-md-6">
                                <p class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i> جميع الباقات تشمل <strong>دومين مجاني</strong> لمدة سنة واحدة</p>
                                <p class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i> جميع الباقات تشمل <strong>استضافة مجانية</strong> لمدة سنة واحدة</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i> يمكن تخصيص أي باقة حسب احتياجاتك الخاصة</p>
                                <p class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i> للباقات المخصصة، <a href="{{ route('contact') }}" class="text-primary">تواصل معنا</a> للحصول على عرض سعر</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->

    @include('components.footer')
@endsection
