@echo off
chcp 65001 >nul
echo ========================================
echo   مسح الكاش - Laravel Cache Clear
echo ========================================
echo.

echo [1/5] مسح كاش Laravel...
php artisan cache:clear
if %errorlevel% neq 0 (
    echo ⚠️ تحذير: فشل مسح cache
)
echo.

echo [2/5] مسح كاش التكوين...
php artisan config:clear
if %errorlevel% neq 0 (
    echo ⚠️ تحذير: فشل مسح config
)
echo.

echo [3/5] مسح كاش الـ Views...
php artisan view:clear
if %errorlevel% neq 0 (
    echo ⚠️ تحذير: فشل مسح views
)
echo.

echo [4/5] مسح كاش الـ Routes...
php artisan route:clear
if %errorlevel% neq 0 (
    echo ⚠️ تحذير: فشل مسح routes
)
echo.

echo [5/5] مسح جميع أنواع الكاش...
php artisan optimize:clear
if %errorlevel% neq 0 (
    echo ⚠️ تحذير: فشل مسح optimize
)
echo.

echo ========================================
echo   ✅ تم مسح الكاش بنجاح!
echo ========================================
echo.
echo 📝 ملاحظات:
echo    - امسح كاش المتصفح (Ctrl+Shift+Delete)
echo    - أعد تحميل الصفحة (Ctrl+F5)
echo.
timeout /t 3 >nul

