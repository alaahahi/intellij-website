<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CacheController extends Controller
{
    /**
     * عرض صفحة مسح الكاش
     */
    public function index()
    {
        return view('admin.cache.index');
    }

    /**
     * مسح نوع محدد من الكاش
     */
    public function clear(Request $request)
    {
        $type = $request->input('type', 'all');
        $results = [];

        try {
            switch ($type) {
                case 'cache':
                    Artisan::call('cache:clear');
                    $results['cache'] = ['success' => true, 'message' => 'تم مسح كاش Laravel بنجاح'];
                    break;

                case 'config':
                    Artisan::call('config:clear');
                    $results['config'] = ['success' => true, 'message' => 'تم مسح كاش التكوين بنجاح'];
                    break;

                case 'view':
                    Artisan::call('view:clear');
                    $results['view'] = ['success' => true, 'message' => 'تم مسح كاش الـ Views بنجاح'];
                    break;

                case 'route':
                    Artisan::call('route:clear');
                    $results['route'] = ['success' => true, 'message' => 'تم مسح كاش الـ Routes بنجاح'];
                    break;

                case 'all':
                    Artisan::call('optimize:clear');
                    $results['all'] = ['success' => true, 'message' => 'تم مسح جميع أنواع الكاش بنجاح'];
                    break;

                default:
                    return back()->with('error', 'نوع الكاش غير صحيح');
            }

            return back()->with('success', 'تم مسح الكاش بنجاح')->with('results', $results);

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    /**
     * مسح جميع أنواع الكاش دفعة واحدة
     */
    public function clearAll()
    {
        try {
            Artisan::call('optimize:clear');
            
            // مسح كاش إضافي
            $commands = [
                'cache:clear',
                'config:clear',
                'view:clear',
                'route:clear',
            ];

            $results = [];
            foreach ($commands as $command) {
                Artisan::call($command);
                $results[$command] = ['success' => true];
            }

            return back()->with('success', 'تم مسح جميع أنواع الكاش بنجاح')->with('results', $results);

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    /**
     * الحصول على معلومات الكاش
     */
    public function info()
    {
        $info = [
            'cache_size' => $this->getCacheSize(),
            'views_count' => $this->getViewsCount(),
            'config_cached' => file_exists(base_path('bootstrap/cache/config.php')),
            'routes_cached' => file_exists(base_path('bootstrap/cache/routes-v7.php')),
        ];

        return response()->json($info);
    }

    /**
     * حساب حجم الكاش
     */
    private function getCacheSize()
    {
        $cachePath = storage_path('framework/cache');
        if (!File::exists($cachePath)) {
            return '0 KB';
        }

        $size = 0;
        foreach (File::allFiles($cachePath) as $file) {
            $size += $file->getSize();
        }

        return $this->formatBytes($size);
    }

    /**
     * عدد ملفات الـ Views المخزنة
     */
    private function getViewsCount()
    {
        $viewsPath = storage_path('framework/views');
        if (!File::exists($viewsPath)) {
            return 0;
        }

        return count(File::allFiles($viewsPath));
    }

    /**
     * تحويل البايتات إلى صيغة مقروءة
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}

