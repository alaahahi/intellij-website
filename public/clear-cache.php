<?php
/**
 * سكريبت مسح الكاش لـ Laravel
 * يمكن تشغيله مباشرة من المتصفح أو من سطر الأوامر
 * 
 * الاستخدام:
 * - من المتصفح: http://localhost/intellij-website/public/clear-cache.php
 * - من سطر الأوامر: php clear-cache.php
 */

// تحديد مسار Laravel
$laravelPath = __DIR__;

// التحقق من وجود artisan
if (!file_exists($laravelPath . '/artisan')) {
    die('❌ خطأ: لم يتم العثور على ملف artisan. تأكد من أن الملف في المجلد الصحيح.');
}

echo "<!DOCTYPE html>
<html dir='rtl' lang='ar'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>مسح الكاش - Laravel</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%%, #764ba2 100%%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            max-width: 600px;
            width: 100%%;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }
        .result {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            border-right: 4px solid #667eea;
        }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .info { color: #17a2b8; }
        .btn {
            display: block;
            width: 100%%;
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            text-align: center;
        }
        .btn:hover { background: #5568d3; }
        pre {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🔄 مسح الكاش - Laravel</h1>";

// قائمة الأوامر
$commands = [
    'cache:clear' => 'مسح كاش Laravel',
    'config:clear' => 'مسح كاش التكوين',
    'view:clear' => 'مسح كاش الـ Views',
    'route:clear' => 'مسح كاش الـ Routes',
    'optimize:clear' => 'مسح جميع أنواع الكاش'
];

$results = [];
$allSuccess = true;

foreach ($commands as $command => $description) {
    echo "<div class='result'>";
    echo "<strong>📋 $description</strong><br>";
    
    // تنفيذ الأمر
    $output = [];
    $returnVar = 0;
    $fullCommand = "cd \"$laravelPath\" && php artisan $command 2>&1";
    
    exec($fullCommand, $output, $returnVar);
    
    if ($returnVar === 0) {
        echo "<span class='success'>✅ نجح</span>";
        if (!empty($output)) {
            echo "<pre>" . htmlspecialchars(implode("\n", $output)) . "</pre>";
        }
    } else {
        echo "<span class='error'>❌ فشل</span>";
        $allSuccess = false;
        if (!empty($output)) {
            echo "<pre>" . htmlspecialchars(implode("\n", $output)) . "</pre>";
        }
    }
    
    echo "</div>";
    $results[$command] = ['success' => $returnVar === 0, 'output' => $output];
}

// ملخص النتائج
echo "<div class='result'>";
if ($allSuccess) {
    echo "<span class='success'>✅ تم مسح جميع أنواع الكاش بنجاح!</span><br><br>";
    echo "<span class='info'>📝 الخطوات التالية:</span><br>";
    echo "1. امسح كاش المتصفح (Ctrl+Shift+Delete)<br>";
    echo "2. أعد تحميل الصفحة (Ctrl+F5)<br>";
    echo "3. إذا قمت بتعديل CSS/JS، شغل: npm run build";
} else {
    echo "<span class='error'>⚠️ حدثت بعض الأخطاء. تحقق من الصلاحيات.</span>";
}
echo "</div>";

echo "<a href='/' class='btn'>🏠 العودة للصفحة الرئيسية</a>";
echo "</div></body></html>";
?>

