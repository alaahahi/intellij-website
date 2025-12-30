@extends('layouts.app')

@section('title', 'المميزات - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'المميزات'])

    <main id="main-content" role="main">
    <!-- Feature Start -->
    <div class="container-fluid feature overflow-hidden py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">المميزات</h4>
                <h1 class="display-5 mb-4">مميزات مهمة لحلولنا التقنية</h1>
                <p class="mb-0">نقدم حلولاً تقنية متطورة تتميز بالجودة العالية والأداء المتميز والأمان القوي.
                </p>
            </div>
            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-shield-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">الأمان والحماية <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">أنظمة أمان متقدمة لحماية بياناتك ومعلوماتك الحساسة</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-tachometer-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">أداء عالي <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">أداء فائق السرعة وتجربة مستخدم سلسة وسريعة</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-headset fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">دعم فني مستمر <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">فريق دعم فني محترف متاح لمساعدتك في أي وقت</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-sync-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">تحديثات مستمرة <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">تحديثات وتحسينات مستمرة لإضافة المزيد من المميزات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->
    </main>

    @include('components.footer')
@endsection
