# Laravel Project Setup

تم تحويل المشروع إلى Laravel بنجاح!

## الهيكل الجديد

```
saas-website-template/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php          # Layout الرئيسي
│       ├── components/
│       │   ├── header.blade.php       # Component الهيدر الموحد
│       │   ├── footer.blade.php       # Component الفوتر الموحد
│       │   └── breadcrumb.blade.php   # Component للـ breadcrumb
│       └── pages/
│           ├── index.blade.php        # الصفحة الرئيسية
│           ├── about.blade.php
│           ├── contact.blade.php
│           ├── service.blade.php
│           ├── contracts-system.blade.php
│           ├── feature.blade.php
│           ├── testimonial.blade.php
│           ├── pricing.blade.php
│           └── blog.blade.php
├── routes/
│   └── web.php                        # Routes المشروع
├── public/
│   ├── css/                           # ملفات CSS
│   ├── js/                            # ملفات JavaScript
│   ├── img/                           # الصور
│   └── lib/                           # المكتبات الخارجية
└── app/
    └── Http/
        └── Controllers/              # Controllers (يمكن إضافتها لاحقاً)
```

## المميزات

1. **Layout موحد**: جميع الصفحات تستخدم `layouts/app.blade.php`
2. **Components مشتركة**: 
   - `header.blade.php` - الهيدر الموحد
   - `footer.blade.php` - الفوتر الموحد
   - `breadcrumb.blade.php` - Breadcrumb للصفحات الداخلية
3. **Routes منظمة**: جميع الروابط في `routes/web.php`
4. **Asset Helper**: استخدام `asset()` helper لجميع الملفات الثابتة

## الخطوات التالية

1. **تثبيت Laravel** (إذا لم يكن مثبتاً):
   ```bash
   composer install
   ```

2. **إعداد البيئة**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **تشغيل المشروع**:
   ```bash
   php artisan serve
   ```

4. **الوصول للموقع**:
   ```
   http://localhost:8000
   ```

## Routes المتاحة

- `/` - الصفحة الرئيسية
- `/about` - من نحن
- `/service` - خدماتنا
- `/contact` - اتصل بنا
- `/contracts-system` - نظام العقود الإلكترونية
- `/feature` - المميزات
- `/testimonial` - آراء العملاء
- `/pricing` - الأسعار
- `/blog` - المشاريع

## ملاحظات

- جميع الملفات الثابتة (CSS, JS, Images, Lib) موجودة في `public/`
- يمكن إضافة Controllers لاحقاً إذا احتجت منطق معقد
- جميع الروابط تستخدم `route()` helper
- جميع الملفات الثابتة تستخدم `asset()` helper
