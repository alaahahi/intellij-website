@extends('layouts.app')

@section('title', 'آراء العملاء - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'آراء العملاء'])

    <main id="main-content" role="main">
    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">آراء العملاء</h4>
                <h1 class="display-5 mb-4">ماذا يقول عملاؤنا عنا</h1>
                <p class="mb-0">نفخر بثقة عملائنا ورضاهم عن خدماتنا.
                </p>
            </div>
            <div class="testimonial-carousel owl-carousel wow zoomInDown" data-wow-delay="0.2s">
                <div class="testimonial-item" data-dot="<img class='img-fluid' src='{{ asset('img/testimonial-img-1.jpg') }}' alt='' loading='lazy'>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('img/testimonial-img-1.jpg') }}" class="img-fluid rounded-circle" alt="" loading="lazy">
                            </div>
                            <div>
                                <h5 class="mb-2">أحمد محمد</h5>
                                <p class="mb-0">مدير معرض سيارات</p>
                            </div>
                        </div>
                        <p class="fs-7">نظام العقود الإلكترونية سهل عملية البيع بشكل كبير. واجهة سهلة الاستخدام ودعم فني ممتاز.
                        </p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    </main>

    @include('components.footer')
@endsection
