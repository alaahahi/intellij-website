<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * عرض صفحة إدارة الفيديوهات
     */
    public function index()
    {
        return view('admin.videos.index');
    }
}

