# 🔄 سكريبتات مسح الكاش

تم إنشاء عدة طرق لمسح الكاش في Laravel:

## الطرق المتاحة

### 1. سكريبت Windows (clear-cache.bat) ⭐ الأسهل
```bash
clear-cache.bat
```
- انقر نقراً مزدوجاً على الملف
- أو شغله من سطر الأوامر

### 2. من المتصفح (clear-cache.php)
```
http://localhost/intellij-website/public/clear-cache.php
```
- واجهة جميلة مع نتائج مفصلة
- يعمل مباشرة من المتصفح

### 3. من Laravel Route
```
http://localhost:8000/clear-cache
```
- أو إذا كنت تستخدم XAMPP:
```
http://localhost/intellij-website/public/clear-cache
```

### 4. سكريبت Linux/Mac (clear-cache.sh)
```bash
bash clear-cache.sh
```
أو:
```bash
chmod +x clear-cache.sh
./clear-cache.sh
```

### 5. من سطر الأوامر مباشرة
```bash
php artisan optimize:clear
```

## ما يتم مسحه

✅ كاش Laravel (`cache:clear`)
✅ كاش التكوين (`config:clear`)
✅ كاش الـ Views (`view:clear`)
✅ كاش الـ Routes (`route:clear`)
✅ جميع أنواع الكاش (`optimize:clear`)

## بعد مسح الكاش

1. **امسح كاش المتصفح**: `Ctrl + Shift + Delete` أو `Ctrl + F5`
2. **إذا عدلت CSS/JS**: شغل `npm run build`
3. **أعد تحميل الصفحة**: `Ctrl + F5`

## ملاحظات مهمة

⚠️ **في بيئة الإنتاج**: احذف route `/clear-cache` من `routes/web.php` لأسباب أمنية

⚠️ **للأمان**: يمكنك إضافة middleware للتحقق من الصلاحيات قبل السماح بمسح الكاش

## استخدام على السيرفر

### Windows Server:
- استخدم `clear-cache.bat`
- أو `clear-cache.php` من المتصفح

### Linux Server:
- استخدم `clear-cache.sh`
- أو أضف الأمر في cron job

### من cPanel/WHM:
- استخدم File Manager لتشغيل `clear-cache.php`
- أو استخدم Terminal/SSH لتشغيل الأوامر

