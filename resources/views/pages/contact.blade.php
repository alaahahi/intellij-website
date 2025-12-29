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
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="الاسم" value="{{ old('name') }}" required>
                                    <label for="name">الاسم</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required>
                                    <label for="email">البريد الإلكتروني</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="الجوال" value="{{ old('phone') }}">
                                    <label for="phone">رقم الجوال</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('project_type') is-invalid @enderror" id="project" name="project_type" placeholder="المشروع" value="{{ old('project_type') }}">
                                    <label for="project">نوع المشروع</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="الموضوع" value="{{ old('subject') }}">
                                    <label for="subject">الموضوع</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control @error('message') is-invalid @enderror" placeholder="اترك رسالتك هنا" id="message" name="message" style="height: 160px" required>{{ old('message') }}</textarea>
                                    <label for="message">الرسالة</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-3">إرسال الرسالة</button>
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
                            <p class="mb-0">
                                <a href="tel:+9647511077812" class="text-decoration-none" style="color: inherit;">
                                    009647511077812
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-envelope-open fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>البريد الإلكتروني</h4>
                            <p class="mb-0">
                                <a href="mailto:alaa.hahe@gmail.com" class="text-decoration-none" style="color: inherit;">
                                    alaa.hahe@gmail.com
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    @include('components.footer')

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // التحقق من وجود معلومات طلب الديمو في localStorage
            const demoRequestData = localStorage.getItem('demoRequest');
            const urlParams = new URLSearchParams(window.location.search);
            const isDemoRequest = urlParams.get('demo') === 'contracts-system';

            if (demoRequestData && isDemoRequest) {
                try {
                    const demoData = JSON.parse(demoRequestData);
                    
                    // ملء الفورم بالمعلومات المحفوظة
                    const subjectField = document.getElementById('subject');
                    const messageField = document.getElementById('message');
                    const projectField = document.getElementById('project');
                    
                    if (subjectField && demoData.subject) {
                        subjectField.value = demoData.subject;
                    }
                    
                    if (messageField && demoData.message) {
                        messageField.value = demoData.message;
                    }
                    
                    if (projectField && demoData.project_type) {
                        projectField.value = demoData.project_type;
                    }

                    // إضافة تنبيه للمستخدم
                    const formContainer = document.querySelector('form');
                    if (formContainer) {
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-info alert-dismissible fade show';
                        alertDiv.innerHTML = `
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>طلب ديمو تجريبي:</strong> تم ملء النموذج تلقائياً. يرجى إكمال باقي المعلومات وإرسال الطلب.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `;
                        formContainer.insertBefore(alertDiv, formContainer.firstChild);
                    }

                    // حذف البيانات من localStorage بعد الاستخدام
                    localStorage.removeItem('demoRequest');
                } catch (e) {
                    console.error('Error parsing demo request data:', e);
                }
            }
        });
    </script>
    @endpush
@endsection
