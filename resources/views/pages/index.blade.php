@extends('layouts.app')

@section('title', 'التطبيق الذكي - حلول تقنية متطورة')

@section('content')
    @include('components.header', ['showHero' => true, 'headerClass' => 'header position-relative overflow-hidden p-0', 'navbarClass' => 'fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-0'])

    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5" style="margin-top: 6rem;">
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
                    <p class="mb-4">نحن فريق من المطورين المحترفين متخصصون في تطوير الحلول البرمجية والأنظمة الإلكترونية المبتكرة. نقدم خدمات شاملة من التصميم إلى التطوير والبرمجة والصيانة، مع التركيز على الجودة والابتكار ورضا العملاء.
                    </p>
                    <a href="{{ route('about') }}" class="btn btn-primary rounded-pill py-3 px-5">المزيد عنا</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="mb-1 text-primary">خدماتنا</h4>
                <h1 class="display-5 mb-4">ماذا يمكننا أن نقدم لك</h1>
                <p class="mb-0">نقدم مجموعة شاملة من الخدمات التقنية والبرمجية التي تغطي جميع احتياجاتك التقنية. من تطوير المواقع والتطبيقات إلى الأنظمة الإلكترونية المتخصصة، نحن هنا لتحويل رؤيتك إلى واقع.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-globe fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">تطوير المواقع الإلكترونية</h4>
                            <p class="mb-4">نطور مواقع ويب احترافية متجاوبة مع جميع الأجهزة باستخدام أحدث التقنيات
                            </p>
                            <a href="{{ route('service') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-mobile-alt fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">تطوير التطبيقات</h4>
                            <p class="mb-4">تطوير تطبيقات موبايل وتطبيقات سطح المكتب بواجهات سهلة الاستخدام
                            </p>
                            <a href="{{ route('service') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-file-contract fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">نظام العقود الإلكترونية</h4>
                            <p class="mb-4">نظام متخصص لإدارة العقود الإلكترونية للمعارض السيارات
                            </p>
                            <a href="{{ route('contracts-system') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center rounded p-4">
                        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4"><i class="fas fa-cogs fa-5x text-secondary"></i></div>
                        <div class="service-content">
                            <h4 class="mb-4">أنظمة إدارة متخصصة</h4>
                            <p class="mb-4">أنظمة إدارة متخصصة مصممة خصيصاً لتلبية احتياجات عملك
                            </p>
                            <a href="{{ route('service') }}" class="btn btn-light rounded-pill text-primary py-2 px-4">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Feature Start -->
    <div class="container-fluid feature overflow-hidden py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">المميزات</h4>
                <h1 class="display-5 mb-4">مميزات مهمة لحلولنا التقنية</h1>
                <p class="mb-0">نقدم حلولاً تقنية متطورة تتميز بالجودة العالية والأداء المتميز والأمان القوي. نضمن لك تجربة مستخدم استثنائية مع دعم فني مستمر.
                </p>
            </div>
            <div class="row g-4 justify-content-center text-center mb-5">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-shield-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">الأمان والحماية <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">أنظمة أمان متقدمة لحماية بياناتك ومعلوماتك الحساسة
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-tachometer-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">أداء عالي <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">أداء فائق السرعة وتجربة مستخدم سلسة وسريعة
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-headset fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">دعم فني مستمر <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">فريق دعم فني محترف متاح لمساعدتك في أي وقت
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-sync-alt fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">تحديثات مستمرة <i class="fa fa-long-arrow-alt-left"></i></a>
                            <p class="mt-4 mb-0">تحديثات وتحسينات مستمرة لإضافة المزيد من المميزات
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="my-3">
                        <a href="{{ route('feature') }}" class="btn btn-primary d-inline rounded-pill px-5 py-3">المزيد من المميزات</a>
                    </div>
                </div>
            </div>
            <div class="row g-5 pt-5" style="margin-top: 6rem;">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="feature-img RotateMoveLeft h-100" style="object-fit: cover;">
                        <img src="{{ asset('img/features-1.png') }}" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.1s">
                    <h4 class="text-primary">الإحصائيات</h4>
                    <h1 class="display-5 mb-4">إنجازاتنا تتحدث عنا</h1>
                    <p class="mb-4">نفخر بثقة عملائنا وإنجازاتنا في مجال التطوير البرمجي. نسعى دائماً لتقديم أفضل الحلول التقنية التي تساهم في نجاح أعمال عملائنا.
                    </p>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="d-flex">
                                <i class="fas fa-project-diagram fa-4x text-secondary"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h2 class="mb-0 fw-bold">150+</h2>
                                    <small class="text-dark">مشروع منجز</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex">
                                <i class="fas fa-users fa-4x text-secondary"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h2 class="mb-0 fw-bold">120+</h2>
                                    <small class="text-dark">عميل راضٍ</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <a href="{{ route('about') }}" class="btn btn-primary rounded-pill py-3 px-5">المزيد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- FAQ Start -->
    <div class="container-fluid FAQ bg-light overflow-hidden py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                   <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseTOne">
                                    لماذا تختار خدماتنا؟
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>حلول تقنية متطورة واحترافية</h5>
                                    <p>نقدم حلولاً تقنية متخصصة مصممة خصيصاً لتلبية احتياجاتك. فريقنا المحترف يضمن جودة عالية وأداء متميز في كل مشروع نعمل عليه.</p>
                                    <p>نستخدم أحدث التقنيات والمعايير العالمية في التطوير لضمان الحصول على أفضل النتائج.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    هل هناك رسوم مخفية؟
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>شفافية كاملة في الأسعار</h5>
                                    <p>لا توجد رسوم مخفية. نقدم أسعاراً واضحة ومباشرة لجميع خدماتنا. ستحصل على عرض سعر شامل يغطي جميع متطلبات المشروع.</p>
                                    <p>يمكنك التواصل معنا للحصول على عرض أسعار مخصص لمشروعك.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    ما هي مدة تنفيذ المشروع؟
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>تسليم في الوقت المحدد</h5>
                                    <p>مدة التنفيذ تعتمد على حجم وتعقيد المشروع. نحدد جدول زمني واضح منذ البداية ونسلم المشروع في الوقت المتفق عليه.</p>
                                    <p>نقوم بتحديثك بانتظام حول التقدم في المشروع لضمان الشفافية والثقة.</p>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="FAQ-img RotateMoveRight rounded">
                        <img src="{{ asset('img/about-1.png') }}" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ End -->

    <!-- Pricing Start -->
    <div class="container-fluid price py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">الأسعار</h4>
                <h1 class="display-5 mb-4">باقات مناسبة لجميع الاحتياجات</h1>
                <p class="mb-0">نقدم باقات أسعار مرنة تناسب مختلف احتياجاتك. يمكنك أيضاً الحصول على عرض سعر مخصص لمشروعك الخاص.
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
                            <p><i class="fas fa-check text-success me-1"></i> Pre-built Email Templates</p>
                            <p><i class="fas fa-check text-success me-1"></i> Reporting & Analytics</p>
                            <p><i class="fas fa-check text-success me-1"></i> Forms & Landing Pages</p>
                            <p><i class="fas fa-check text-success me-1"></i> A/B Testing</p>
                            <p><i class="fas fa-check text-success me-1"></i> Email Scheduling</p>
                            <p><i class="fas fa-check text-success me-1"></i> Automated Customer Journeys</p>
                            <p><i class="fas fa-times text-danger me-1"></i> Creative Assistant</p>
                            <p class="mb-4"><i class="fas fa-times text-danger me-1"></i> Role-based Access</p>
                            <button class="btn btn-light rounded-pill py-2 px-5" type="button">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="price-item bg-light rounded text-center">
                        <div class="pice-item-offer">Popular</div>
                        <div class="text-center text-primary border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 160px;">
                            <p class="fs-2 fw-bold text-uppercase mb-0">Standard</p>
                            <div class="d-flex justify-content-center">
                                <strong class="align-self-start">$</strong>
                                <p class="mb-0"><span class="display-5">23</span>/mo</p>
                            </div>                        
                        </div>
                        <div class="text-start p-5">
                            <p><i class="fas fa-check text-success me-1"></i> Limited Acess Library</p>
                            <p><i class="fas fa-check text-success me-1"></i> Customer Support</p>
                            <p><i class="fas fa-check text-success me-1"></i> Pre-built Email Templates</p>
                            <p><i class="fas fa-check text-success me-1"></i> Reporting & Analytics</p>
                            <p><i class="fas fa-check text-success me-1"></i> Forms & Landing Pages</p>
                            <p><i class="fas fa-check text-success me-1"></i> A/B Testing</p>
                            <p><i class="fas fa-check text-success me-1"></i> Email Scheduling</p>
                            <p><i class="fas fa-check text-success me-1"></i> Automated Customer Journeys</p>
                            <p><i class="fas fa-times text-danger me-1"></i> Creative Assistant</p>
                            <p class="mb-4"><i class="fas fa-times text-danger me-1"></i> Role-based Access</p>
                            <button class="btn btn-light rounded-pill py-2 px-5" type="button">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="price-item bg-light rounded text-center">
                        <div class="text-center text-secondary border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 160px;">
                            <p class="fs-2 fw-bold text-uppercase mb-0">Premium</p>
                            <div class="d-flex justify-content-center">
                                <strong class="align-self-start">$</strong>
                                <p class="mb-0"><span class="display-5">49</span>/mo</p>
                            </div>                        
                        </div>
                        <div class="text-start p-5">
                            <p><i class="fas fa-check text-success me-1"></i> Limited Acess Library</p>
                            <p><i class="fas fa-check text-success me-1"></i> Customer Support</p>
                            <p><i class="fas fa-check text-success me-1"></i> Pre-built Email Templates</p>
                            <p><i class="fas fa-check text-success me-1"></i> Reporting & Analytics</p>
                            <p><i class="fas fa-check text-success me-1"></i> Forms & Landing Pages</p>
                            <p><i class="fas fa-check text-success me-1"></i> A/B Testing</p>
                            <p><i class="fas fa-check text-success me-1"></i> Email Scheduling</p>
                            <p><i class="fas fa-check text-success me-1"></i> Automated Customer Journeys</p>
                            <p><i class="fas fa-times text-danger me-1"></i> Creative Assistant</p>
                            <p class="mb-4"><i class="fas fa-times text-danger me-1"></i> Role-based Access</p>
                            <button class="btn btn-light rounded-pill py-2 px-5" type="button">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">المشاريع</h4>
                <h1 class="display-5 mb-4">مشاريعنا المتميزة</h1>
                <p class="mb-0">استعرض بعضاً من المشاريع الناجحة التي قمنا بتطويرها لعملائنا. كل مشروع يمثل تحدياً جديداً وفرصة لتقديم قيمة حقيقية.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/blog-1.png') }}" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Dec 01.2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                    <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">نظام العقود الإلكترونية</h5>
                            <p class="mb-4">نظام متخصص لإدارة العقود الإلكترونية للمعارض السيارات.</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('contracts-system') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/blog-2.png') }}" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> مشروع <i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">موقع إلكتروني احترافي</h5>
                            <p class="mb-4">تطوير مواقع إلكترونية متجاوبة وحديثة.</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('service') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/blog-3.png') }}" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> مشروع <i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">تطبيق موبايل</h5>
                            <p class="mb-4">تطوير تطبيقات موبايل عالية الجودة.</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('service') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('img/blog-4.png') }}" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> 2024</span>
                                <div class="d-flex">
                                    <span class="me-3"> مشروع <i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4 ">
                            <h5 class="mb-4">نظام إدارة متخصص</h5>
                            <p class="mb-4">أنظمة إدارة مخصصة حسب احتياجاتك.</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="{{ route('service') }}">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">آراء العملاء</h4>
                <h1 class="display-5 mb-4">ماذا يقول عملاؤنا عنا</h1>
                <p class="mb-0">نفخر بثقة عملائنا ورضاهم عن خدماتنا. استمع إلى تجارب عملائنا المميزة معنا.
                </p>
            </div>
            <div class="testimonial-carousel owl-carousel wow zoomInDown" data-wow-delay="0.2s">
                <div class="testimonial-item" data-dot="<img class='img-fluid' src='{{ asset('img/testimonial-img-1.jpg') }}' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('img/testimonial-img-1.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div>
                                <h5 class="mb-2">أحمد محمد</h5>
                                <p class="mb-0">مدير معرض سيارات</p>
                            </div>
                        </div>
                        <p class="fs-7">نظام العقود الإلكترونية سهل عملية البيع بشكل كبير. واجهة سهلة الاستخدام ودعم فني ممتاز. أنصح به بشدة.
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
                <div class="testimonial-item" data-dot="<img class='img-fluid' src='{{ asset('img/testimonial-img-2.jpg') }}' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('img/testimonial-img-2.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div>
                                <h5 class="mb-2">فاطمة علي</h5>
                                <p class="mb-0">صاحبة شركة</p>
                            </div>
                        </div>
                        <p class="fs-7">فريق محترف ومتعاون. قاموا بتطوير موقعنا الإلكتروني بشكل ممتاز وفي الوقت المحدد. خدمة عملاء متميزة.
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
                <div class="testimonial-item" data-dot="<img class='img-fluid' src='{{ asset('img/testimonial-img-3.jpg') }}' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('img/testimonial-img-3.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div>
                                <h5 class="mb-2">خالد حسن</h5>
                                <p class="mb-0">رائد أعمال</p>
                            </div>
                        </div>
                        <p class="fs-7">حلول تقنية متطورة وأسعار منافسة. استفدت من خدماتهم كثيراً وأخطط للتعاون معهم في مشاريع مستقبلية.
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
@endsection
