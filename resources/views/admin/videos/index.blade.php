@extends('admin.layout')

@section('title', 'إدارة الفيديوهات - لوحة التحكم')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5">إدارة الفيديوهات التعليمية</h1>
        </div>

        <div class="alert alert-info">
            <h5 class="alert-heading">
                <i class="fas fa-info-circle"></i> كيفية إضافة الفيديوهات
            </h5>
            <p class="mb-0">
                لإضافة أو تعديل الفيديوهات التعليمية، افتح ملف:
                <code>resources/views/pages/accounting-system.blade.php</code>
                وابحث عن <code>$videos = [</code> ثم أضف الفيديوهات في المصفوفة.
            </p>
            <hr>
            <p class="mb-0">
                <strong>صيغة الفيديو:</strong><br>
                <code>
                    [<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'title' => 'عنوان الفيديو',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'description' => 'وصف الفيديو',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'video_url' => 'https://www.youtube.com/watch?v=VIDEO_ID',<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'thumbnail' => null,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;'duration' => '10:30',<br>
                    ],
                </code>
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-file-code"></i> ملف الفيديوهات
                        </h5>
                    </div>
                    <div class="card-body">
                        <p><strong>المسار:</strong></p>
                        <code class="d-block p-3 bg-light rounded">
                            resources/views/pages/accounting-system.blade.php
                        </code>
                        <p class="mt-3"><strong>السطر التقريبي:</strong> 414</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-link"></i> رابط الصفحة
                        </h5>
                    </div>
                    <div class="card-body">
                        <p><strong>صفحة الفيديوهات:</strong></p>
                        <a href="{{ route('accounting-system') }}#videos" target="_blank" class="btn btn-primary">
                            <i class="fas fa-external-link-alt"></i> فتح صفحة الفيديوهات
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-question-circle"></i> دليل الاستخدام
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6>1. افتح ملف accounting-system.blade.php</h6>
                        <p>اذهب إلى: <code>resources/views/pages/accounting-system.blade.php</code></p>

                        <h6 class="mt-4">2. ابحث عن قائمة الفيديوهات</h6>
                        <p>ابحث عن: <code>@php $videos = [</code></p>

                        <h6 class="mt-4">3. أضف فيديو جديد</h6>
                        <pre class="bg-light p-3 rounded"><code>[
    'title' => 'عنوان الفيديو',
    'description' => 'وصف الفيديو',
    'video_url' => 'https://www.youtube.com/watch?v=VIDEO_ID',
    'thumbnail' => null,
    'duration' => '10:30',
],</code></pre>

                        <h6 class="mt-4">4. صيغ روابط YouTube المدعومة:</h6>
                        <ul>
                            <li><code>https://www.youtube.com/watch?v=VIDEO_ID</code></li>
                            <li><code>https://youtu.be/VIDEO_ID</code></li>
                            <li><code>https://www.youtube.com/embed/VIDEO_ID</code></li>
                        </ul>

                        <h6 class="mt-4">5. Vimeo:</h6>
                        <ul>
                            <li><code>https://vimeo.com/VIDEO_ID</code></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

