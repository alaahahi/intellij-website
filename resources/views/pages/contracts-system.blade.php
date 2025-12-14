@extends('layouts.app')

@section('title', 'نظام العقود الإلكترونية - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'نظام العقود الإلكترونية'])

    <!-- Contracts System Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="mb-1 text-primary">نظام العقود الإلكترونية</h4>
                <h1 class="display-5 mb-4">نظام متخصص لإدارة العقود الإلكترونية</h1>
                <p class="mb-0">نظام متخصص لإدارة العقود الإلكترونية للمعارض السيارات. يوفر حلولاً شاملة لإدارة جميع أنواع العقود والاتفاقيات.
                </p>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <img src="{{ asset('img/blog-1.png') }}" class="img-fluid w-100" alt="">
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <h4 class="text-primary mb-4">المميزات الرئيسية</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> إدارة شاملة للعقود</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> توقيع إلكتروني آمن</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تتبع حالة العقود</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> تقارير مفصلة</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5">تواصل معنا</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Contracts System End -->
@endsection
