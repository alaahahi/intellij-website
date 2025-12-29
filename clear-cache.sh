#!/bin/bash

# سكريبت مسح الكاش لـ Laravel (Linux/Mac)
# الاستخدام: bash clear-cache.sh

echo "========================================"
echo "  مسح الكاش - Laravel Cache Clear"
echo "========================================"
echo ""

# التحقق من وجود artisan
if [ ! -f "artisan" ]; then
    echo "❌ خطأ: لم يتم العثور على ملف artisan"
    exit 1
fi

echo "[1/5] مسح كاش Laravel..."
php artisan cache:clear
echo ""

echo "[2/5] مسح كاش التكوين..."
php artisan config:clear
echo ""

echo "[3/5] مسح كاش الـ Views..."
php artisan view:clear
echo ""

echo "[4/5] مسح كاش الـ Routes..."
php artisan route:clear
echo ""

echo "[5/5] مسح جميع أنواع الكاش..."
php artisan optimize:clear
echo ""

echo "========================================"
echo "  ✅ تم مسح الكاش بنجاح!"
echo "========================================"
echo ""
echo "📝 ملاحظات:"
echo "   - امسح كاش المتصفح"
echo "   - أعد تحميل الصفحة (Ctrl+F5)"
echo ""

