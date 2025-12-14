@extends('layouts.app')

@section('title', 'اتصل بنا - التطبيق الذكي')

@section('content')
    @include('components.header', ['headerClass' => 'p-0', 'navbarClass' => 'navbar-light bg-transparent px-4 px-lg-5 py-3 py-lg-0'])
    @include('components.breadcrumb', ['title' => 'اتصل بنا'])

    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary mb-4">اتصل بنا</h4>
                <h1 class="display-5 mb-4">تواصل معنا</h1>
                <p class="mb-0">نحن هنا لمساعدتك. تواصل معنا للحصول على استشارة مجانية أو طلب عرض سعر لمشروعك. فريقنا سيكون سعيداً للإجابة على جميع استفساراتك.
                </p>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h2 class="display-5 mb-2">نموذج الاتصال</h2>
                    <p class="mb-4">املأ النموذج أدناه وسنرد عليك في أقرب وقت ممكن. يمكنك أيضاً التواصل معنا عبر الهاتف أو البريد الإلكتروني.</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="الاسم">
                                    <label for="name">الاسم</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="البريد الإلكتروني">
                                    <label for="email">البريد الإلكتروني</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="phone" class="form-control" id="phone" placeholder="الجوال">
                                    <label for="phone">رقم الجوال</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="project" placeholder="المشروع">
                                    <label for="project">نوع المشروع</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="الموضوع">
                                    <label for="subject">الموضوع</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="اترك رسالتك هنا" id="message" style="height: 160px"></textarea>
                                    <label for="message">الرسالة</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">إرسال الرسالة</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-home fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>العنوان</h4>
                            <p class="mb-0">العراق - أربيل</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-phone-alt fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>الجوال</h4>
                            <p class="mb-0">00964 - 7511077812</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-envelope-open fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>البريد الإلكتروني</h4>
                            <p class="mb-0">alaa.hahe@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
