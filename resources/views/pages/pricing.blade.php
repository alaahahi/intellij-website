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
                <h1 class="display-5 mb-4">باقات مناسبة لجميع الاحتياجات</h1>
                <p class="mb-0">نقدم باقات أسعار مرنة تناسب مختلف احتياجاتك.
                </p>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="price-item bg-light rounded text-center">
                        <div class="text-center text-dark border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 160px;">
                            <p class="fs-2 fw-bold text-uppercase mb-0">BASIC</p>
                            <div class="d-flex justify-content-center">
                                <strong class="align-self-start">$</strong>
                                <p class="mb-0"><span class="display-5">00</span>/mo</p>
                            </div>                        
                        </div>
                        <div class="text-start p-5">
                            <p><i class="fas fa-check text-success me-1"></i> Limited Acess Library</p>
                            <p><i class="fas fa-check text-success me-1"></i> Customer Support</p>
                            <button class="btn btn-light rounded-pill py-2 px-5" type="button">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->
@endsection
