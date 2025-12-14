# SaaS Website Template - Laravel

مشروع موقع SaaS مبني على Laravel مع دعم كامل للغة العربية (RTL).

## المميزات

- ✅ Laravel Framework 10.x
- ✅ Blade Templates
- ✅ Components موحدة (Header, Footer, Breadcrumb)
- ✅ دعم كامل للغة العربية (RTL)
- ✅ تصميم متجاوب
- ✅ صفحات متعددة
- ✅ Composer & Dependencies
- ✅ Git Repository

## التثبيت السريع

### المتطلبات
- PHP >= 8.1
- Composer
- MySQL أو SQLite (اختياري)

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

للتفاصيل الكاملة، راجع [INSTALLATION.md](INSTALLATION.md)

## الهيكل

```
├── app/
│   ├── Console/           # Artisan Commands
│   ├── Exceptions/        # Exception Handlers
│   ├── Http/             # Controllers, Middleware
│   ├── Models/           # Eloquent Models
│   └── Providers/        # Service Providers
├── bootstrap/            # Bootstrap Files
├── config/               # Configuration Files
├── database/             # Migrations, Seeders
├── public/               # Public Assets
│   ├── css/             # CSS Files
│   ├── js/              # JavaScript Files
│   ├── img/             # Images
│   └── lib/             # External Libraries
├── resources/
│   └── views/
│       ├── layouts/      # Layouts الرئيسية
│       ├── components/   # Components مشتركة
│       └── pages/        # صفحات الموقع
├── routes/               # Route Definitions
├── storage/              # Storage Files
└── tests/                # Tests
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

## الأوامر المفيدة

### Artisan Commands

```bash
# عرض معلومات Laravel
php artisan about

# مسح Cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# تحسين الأداء
php artisan config:cache
php artisan route:cache
php artisan view:cache

# عرض Routes
php artisan route:list
```

### Composer Commands

```bash
# تثبيت Dependencies
composer install

# تحديث Dependencies
composer update

# تحديث Autoloader
composer dump-autoload
```

### Git Commands

```bash
# عرض حالة الملفات
git status

# إضافة ملفات
git add .

# عمل commit
git commit -m "رسالة الـ commit"

# رفع التغييرات
git push origin master
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

## الإصدار

- Laravel: 10.50.0
- PHP: >= 8.1
