# SaaS Website Template - Laravel

مشروع موقع SaaS مبني على Laravel مع دعم كامل للغة العربية (RTL).

## المميزات

- ✅ Laravel Framework
- ✅ Blade Templates
- ✅ Components موحدة (Header, Footer, Breadcrumb)
- ✅ دعم كامل للغة العربية (RTL)
- ✅ تصميم متجاوب
- ✅ صفحات متعددة

## التثبيت

### المتطلبات
- PHP >= 8.0
- Composer
- Node.js & NPM (اختياري)

### خطوات التثبيت

1. **استنساخ المشروع**
   ```bash
   git clone <repository-url>
   cd saas-website-template
   ```

2. **تثبيت Dependencies**
   ```bash
   composer install
   ```

3. **إعداد البيئة**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **تشغيل المشروع**
   ```bash
   php artisan serve
   ```

5. **الوصول للموقع**
   ```
   http://localhost:8000
   ```

## الهيكل

```
├── resources/
│   └── views/
│       ├── layouts/          # Layouts الرئيسية
│       ├── components/        # Components مشتركة
│       └── pages/            # صفحات الموقع
├── routes/
│   └── web.php              # Routes المشروع
├── public/                   # الملفات العامة
│   ├── css/                 # ملفات CSS
│   ├── js/                  # ملفات JavaScript
│   ├── img/                 # الصور
│   └── lib/                 # المكتبات الخارجية
└── app/                     # Application Code
```

## الصفحات المتاحة

- `/` - الصفحة الرئيسية
- `/about` - من نحن
- `/service` - خدماتنا
- `/contact` - اتصل بنا
- `/contracts-system` - نظام العقود الإلكترونية
- `/feature` - المميزات
- `/testimonial` - آراء العملاء
- `/pricing` - الأسعار
- `/blog` - المشاريع

## Git

المشروع يحتوي على Git repository جاهز للاستخدام.

### الأوامر الأساسية

```bash
# عرض حالة الملفات
git status

# إضافة ملفات
git add .

# عمل commit
git commit -m "رسالة الـ commit"

# ربط المشروع بـ remote repository
git remote add origin <repository-url>

# رفع التغييرات
git push -u origin master
```

## التطوير

للتطوير على المشروع:

1. إنشاء branch جديد
   ```bash
   git checkout -b feature/new-feature
   ```

2. عمل التعديلات المطلوبة

3. إضافة التغييرات
   ```bash
   git add .
   git commit -m "وصف التغييرات"
   ```

4. رفع التغييرات
   ```bash
   git push origin feature/new-feature
   ```

## الرخصة

هذا المشروع مفتوح المصدر ومتاح للاستخدام الحر.

## الدعم

للدعم والمساعدة، يرجى التواصل عبر:
- البريد الإلكتروني: alaa.hahe@gmail.com
- الهاتف: 00964 - 7511077812
