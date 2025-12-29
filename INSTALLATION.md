# دليل التثبيت - Laravel Project

## المتطلبات

- PHP >= 8.1
- Composer
- MySQL أو SQLite (اختياري)
- Node.js & NPM (اختياري - للتطوير)

## خطوات التثبيت

### 1. تثبيت Dependencies

```bash
composer install
```

### 2. إعداد ملف البيئة

```bash
cp .env.example .env
```

### 3. إنشاء Application Key

```bash
php artisan key:generate
```

### 4. إعداد قاعدة البيانات (اختياري)

عدّل ملف `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=saas_website
DB_USERNAME=root
DB_PASSWORD=
```

ثم قم بتشغيل migrations (إذا كان لديك):

```bash
php artisan migrate
```

### 5. إنشاء Storage Link (للملفات العامة)

```bash
php artisan storage:link
```

### 6. تشغيل المشروع

```bash
php artisan serve
```

الموقع سيكون متاحاً على: `http://localhost:8000`

## أوامر Artisan المفيدة

```bash
# عرض جميع الأوامر المتاحة
php artisan list

# مسح Cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# تحسين الأداء
php artisan config:cache
php artisan route:cache
php artisan view:cache

# عرض معلومات Laravel
php artisan about
```

## استكشاف الأخطاء

### مشكلة في Permissions (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

### مشكلة في Composer

```bash
composer dump-autoload
```

### مسح جميع Cache

```bash
php artisan optimize:clear
```

## ملاحظات

- تأكد من أن مجلد `storage` و `bootstrap/cache` قابل للكتابة
- في بيئة الإنتاج، قم بتعيين `APP_DEBUG=false` في ملف `.env`
- استخدم `php artisan config:cache` في الإنتاج لتحسين الأداء

