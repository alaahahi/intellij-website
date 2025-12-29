# دليل إعداد نظام تسجيل الزيارات

## المميزات

- ✅ تسجيل تلقائي لجميع الزيارات
- ✅ تحديد مصدر الزيارة (Google, Facebook, Direct, etc.)
- ✅ تسجيل معلومات الجهاز والمتصفح
- ✅ إحصائيات مفصلة
- ✅ لوحة تحكم لعرض الزيارات

## إعداد قاعدة البيانات

### 1. إعداد ملف .env

عدّل ملف `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intellijapp
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 2. إنشاء قاعدة البيانات

في MySQL:

```sql
CREATE DATABASE intellijapp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. تشغيل Migration

```bash
php artisan migrate
```

## كيفية العمل

### تسجيل تلقائي

النظام يسجل الزيارات تلقائياً عبر Middleware `TrackVisit` الذي يعمل على جميع الصفحات.

### البيانات المسجلة

- **IP Address** - عنوان IP للزائر
- **User Agent** - معلومات المتصفح
- **Referer** - الصفحة المرجعية
- **Source** - مصدر الزيارة (google, facebook, direct, etc.)
- **URL** - رابط الصفحة الكامل
- **Page** - مسار الصفحة
- **Device** - نوع الجهاز (mobile, tablet, desktop)
- **Browser** - نوع المتصفح (chrome, firefox, safari, etc.)
- **Platform** - نظام التشغيل (windows, macos, linux, android, ios)
- **Visited At** - تاريخ ووقت الزيارة

### مصادر الزيارة المدعومة

- **google** - من محرك بحث Google
- **facebook** - من Facebook
- **twitter** - من Twitter/X
- **instagram** - من Instagram
- **linkedin** - من LinkedIn
- **youtube** - من YouTube
- **bing** - من محرك بحث Bing
- **yahoo** - من Yahoo
- **direct** - زيارة مباشرة (بدون referer)
- **other** - مصادر أخرى

## عرض الإحصائيات

### عبر المتصفح

```
http://localhost:8000/admin/visits
```

### عبر API

```
GET /admin/visits/stats
```

## الاستخدام في الكود

### الحصول على إحصائيات

```php
use App\Models\Visit;

// إجمالي الزيارات
$total = Visit::count();

// زيارات اليوم
$today = Visit::whereDate('visited_at', today())->count();

// زيارات من Google
$google = Visit::where('source', 'google')->count();

// زيارات صفحة معينة
$pageVisits = Visit::where('page', '/about')->count();
```

### فلترة الزيارات

```php
// حسب المصدر
$visits = Visit::where('source', 'facebook')->get();

// حسب التاريخ
$visits = Visit::whereBetween('visited_at', [
    now()->startOfWeek(),
    now()->endOfWeek()
])->get();

// حسب الصفحة
$visits = Visit::where('page', '/contact')->get();
```

## ملاحظات

- النظام يسجل الزيارات تلقائياً ولا يحتاج لأي إعداد إضافي
- يمكن تعطيل التسجيل عبر إزالة Middleware من `app/Http/Kernel.php`
- البيانات محفوظة في جدول `visits` في قاعدة البيانات

