<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-dark mb-4">الشركة</h4>
                    <a href="{{ route('about') }}"> من نحن</a>
                    <a href="{{ route('feature') }}"> المميزات</a>
                    <a href="{{ route('service') }}"> خدماتنا</a>
                    <a href="{{ route('contracts-system') }}"> نظام العقود</a>
                    <a href="{{ route('contact') }}"> اتصل بنا</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-dark">روابط سريعة</h4>
                    <a href="{{ route('about') }}"> من نحن</a>
                    <a href="{{ route('contact') }}"> اتصل بنا</a>
                    <a href="{{ route('service') }}"> خدماتنا</a>
                    <a href="{{ route('contracts-system') }}"> المشاريع</a>
                    <a href="{{ route('testimonial') }}"> آراء العملاء</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-dark">خدماتنا</h4>
                    <a href="{{ route('service') }}"> جميع الخدمات</a>
                    <a href="{{ route('service') }}"> تطوير المواقع</a>
                    <a href="{{ route('service') }}"> تطوير التطبيقات</a>
                    <a href="{{ route('contracts-system') }}"> نظام عقود بيع السيارات</a>
                    <a href="{{ route('service') }}"> أنظمة الإدارة</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-dark">معلومات الاتصال</h4>
                    <a href=""><i class="fa fa-map-marker-alt me-2"></i> العراق - أربيل</a>
                    <a href="mailto:alaa.hahe@gmail.com"><i class="fas fa-envelope me-2"></i> alaa.hahe@gmail.com</a>
                    <a href="tel:+9647511077812"><i class="fas fa-phone me-2"></i> 009647511077812</a>
                    <a href="tel:+9647511077812" class="mb-3"><i class="fas fa-print me-2"></i> 009647511077812</a>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-share fa-2x text-secondary me-2"></i>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="text-white"><a href="#"><i class="fas fa-copyright text-light me-2"></i>التطبيق الذكي</a>, جميع الحقوق محفوظة.</span>
            </div>
            <div class="col-md-6 text-center text-md-end text-white">
                <span>© {{ date('Y') }} جميع الحقوق محفوظة</span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
