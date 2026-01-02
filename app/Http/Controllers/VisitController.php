<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    /**
     * عرض لوحة التحكم Vue.js
     */
    public function dashboard()
    {
        return view('admin.visits.dashboard');
    }

    /**
     * عرض إحصائيات الزيارات
     */
    public function index(Request $request)
    {
        $query = Visit::query();

        // فلترة حسب المصدر
        if ($request->has('source') && $request->source) {
            $query->where('source', $request->source);
        }

        // فلترة حسب التاريخ
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('visited_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('visited_at', '<=', $request->date_to);
        }

        $visits = $query->orderBy('visited_at', 'desc')->paginate(50);

        // إحصائيات
        $stats = [
            'total' => Visit::count(),
            'today' => Visit::whereDate('visited_at', today())->count(),
            'this_week' => Visit::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Visit::whereMonth('visited_at', now()->month)->count(),
            'qr_total' => Visit::where('source', 'qr')->count(),
            'qr_today' => Visit::where('source', 'qr')->whereDate('visited_at', today())->count(),
            'qr_this_week' => Visit::where('source', 'qr')->whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'qr_this_month' => Visit::where('source', 'qr')->whereMonth('visited_at', now()->month)->count(),
        ];

        // إحصائيات حسب المصدر
        $sources = Visit::select('source', DB::raw('count(*) as total'))
            ->groupBy('source')
            ->orderBy('total', 'desc')
            ->get();

        // إحصائيات حسب الصفحة
        $pages = Visit::select('page', DB::raw('count(*) as total'))
            ->groupBy('page')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // إحصائيات طلبات الاتصال
        $contactStats = [
            'total' => \App\Models\ContactRequest::count(),
            'new' => \App\Models\ContactRequest::where('status', 'new')->count(),
            'read' => \App\Models\ContactRequest::where('status', 'read')->count(),
            'replied' => \App\Models\ContactRequest::where('status', 'replied')->count(),
            'archived' => \App\Models\ContactRequest::where('status', 'archived')->count(),
            'today' => \App\Models\ContactRequest::whereDate('created_at', today())->count(),
            'this_week' => \App\Models\ContactRequest::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => \App\Models\ContactRequest::whereMonth('created_at', now()->month)->count(),
        ];

        return view('admin.visits.index', compact('visits', 'stats', 'sources', 'pages', 'contactStats'));
    }

    /**
     * API endpoint للحصول على إحصائيات الزيارات
     */
    public function stats()
    {
        $stats = [
            'total' => Visit::count(),
            'today' => Visit::whereDate('visited_at', today())->count(),
            'this_week' => Visit::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Visit::whereMonth('visited_at', now()->month)->count(),
            'sources' => Visit::select('source', DB::raw('count(*) as total'))
                ->groupBy('source')
                ->orderBy('total', 'desc')
                ->get(),
            'qr_total' => Visit::where('source', 'qr')->count(),
            'qr_today' => Visit::where('source', 'qr')->whereDate('visited_at', today())->count(),
            'qr_this_week' => Visit::where('source', 'qr')->whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'qr_this_month' => Visit::where('source', 'qr')->whereMonth('visited_at', now()->month)->count(),
            'pages' => Visit::select('page', DB::raw('count(*) as total'))
                ->groupBy('page')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get(),
        ];

        return response()->json($stats);
    }

    /**
     * API endpoint للحصول على قائمة الزيارات
     */
    public function apiList(Request $request)
    {
        $query = Visit::query();

        // فلترة حسب المصدر
        if ($request->has('source') && $request->source) {
            $query->where('source', $request->source);
        }

        // فلترة حسب التاريخ
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('visited_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('visited_at', '<=', $request->date_to);
        }

        $perPage = $request->get('per_page', 50);
        $visits = $query->orderBy('visited_at', 'desc')->paginate($perPage);

        return response()->json($visits);
    }
}

