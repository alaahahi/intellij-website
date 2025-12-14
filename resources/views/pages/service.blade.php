@extends('layouts.app')

@section('title', 'خدماتنا - التطبيق الذكي')

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
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-globe fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">تطوير المواقع الإلكترونية</h4>
                            <p class="mb-4">نطور مواقع ويب احترافية متجاوبة مع جميع الأجهزة باستخدام أحدث التقنيات</p>
                            <a href="{{ route('contact') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">تواصل معنا</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-mobile-alt fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">تطوير التطبيقات</h4>
                            <p class="mb-4">تطوير تطبيقات موبايل وتطبيقات سطح المكتب بواجهات سهلة الاستخدام</p>
                            <a href="{{ route('contact') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">تواصل معنا</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-file-contract fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">نظام العقود الإلكترونية</h4>
                            <p class="mb-4">نظام متخصص لإدارة العقود الإلكترونية للمعارض السيارات</p>
                            <a href="{{ route('contracts-system') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-cogs fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">أنظمة إدارة متخصصة</h4>
                            <p class="mb-4">أنظمة إدارة متخصصة مصممة خصيصاً لتلبية احتياجات عملك</p>
                            <a href="{{ route('contact') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">تواصل معنا</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
