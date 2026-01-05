<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * عرض صفحة إدارة الفيديوهات
     */
    public function index(Request $request)
    {
        $query = Video::query()->orderBy('project_route')->orderBy('order');

        // فلترة حسب المشروع
        if ($request->has('project') && $request->project) {
            $query->where('project_route', $request->project);
        }

        // البحث
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $videos = $query->paginate(20);
        
        $projects = [
            'accounting-system' => 'برنامج المحاسب الذكي',
            'contracts-system' => 'نظام عقود بيع السيارات',
            'shipping-system' => 'نظام إدارة سفينة الشحن',
            'dream-city-mall' => 'شركة الهدف المباشر',
        ];

        return view('admin.videos.index', compact('videos', 'projects'));
    }

    /**
     * عرض نموذج إضافة فيديو جديد
     */
    public function create()
    {
        $projects = [
            'accounting-system' => 'برنامج المحاسب الذكي',
            'contracts-system' => 'نظام عقود بيع السيارات',
            'shipping-system' => 'نظام إدارة سفينة الشحن',
            'dream-city-mall' => 'شركة الهدف المباشر',
        ];

        return view('admin.videos.create', compact('projects'));
    }

    /**
     * حفظ فيديو جديد
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_route' => 'required|string|in:accounting-system,contracts-system,shipping-system,dream-city-mall',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|url',
            'duration' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Video::create([
            'project_route' => $request->project_route,
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'thumbnail' => $request->thumbnail,
            'duration' => $request->duration,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'تم إضافة الفيديو بنجاح.');
    }

    /**
     * عرض نموذج تعديل فيديو
     */
    public function edit(Video $video)
    {
        $projects = [
            'accounting-system' => 'برنامج المحاسب الذكي',
            'contracts-system' => 'نظام عقود بيع السيارات',
            'shipping-system' => 'نظام إدارة سفينة الشحن',
            'dream-city-mall' => 'شركة الهدف المباشر',
        ];

        return view('admin.videos.edit', compact('video', 'projects'));
    }

    /**
     * تحديث فيديو
     */
    public function update(Request $request, Video $video)
    {
        $validator = Validator::make($request->all(), [
            'project_route' => 'required|string|in:accounting-system,contracts-system,shipping-system,dream-city-mall',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|url',
            'duration' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $video->update([
            'project_route' => $request->project_route,
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'thumbnail' => $request->thumbnail,
            'duration' => $request->duration,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'تم تحديث الفيديو بنجاح.');
    }

    /**
     * حذف فيديو
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'تم حذف الفيديو بنجاح.');
    }
}
