@extends('layouts.app')

@section('title', 'من نحن - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'من نحن'])

    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5 mt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="RotateMoveLeft">
                        <img src="{{ asset('img/about-1.png') }}" class="img-fluid w-100" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="mb-1 text-primary">من نحن</h4>
                    <h1 class="display-5 mb-4">شركة تقنية متخصصة في تطوير الحلول البرمجية</h1>
                    <p class="mb-4">نحن فريق من المطورين والمبرمجين المحترفين متخصصون في تطوير الحلول البرمجية والأنظمة الإلكترونية المبتكرة. نسعى دائماً لتقديم أفضل الحلول التقنية التي تساهم في نجاح أعمال عملائنا وتحقيق أهدافهم.
                    </p>
                    <p class="mb-4">نقدم خدمات شاملة من التصميم والتطوير إلى البرمجة والصيانة والدعم الفني، مع التركيز على الجودة والابتكار ورضا العملاء.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-primary rounded-pill py-3 px-5">تواصل معنا</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
