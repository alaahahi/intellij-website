@extends('layouts.app')

@section('title', 'المشاريع - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'المشاريع'])

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">المشاريع</h4>
                <h1 class="display-5 mb-4">مشاريعنا المتميزة</h1>
                <p class="mb-0">استعرض بعضاً من المشاريع الناجحة التي قمنا بتطويرها لعملائنا.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/blog-1.png') }}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="blog-content text-dark border p-4">
                            <h5 class="mb-4">نظام العقود الإلكترونية</h5>
                            <p class="mb-4">نظام متخصص لإدارة العقود الإلكترونية للمعارض السيارات.</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('contracts-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
