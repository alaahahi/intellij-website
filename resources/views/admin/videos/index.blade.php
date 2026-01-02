@extends('admin.layout')

@section('title', 'إدارة الفيديوهات')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5">إدارة الفيديوهات التعليمية</h1>
            <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة فيديو جديد
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filters and Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.videos.index') }}" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" 
                               value="{{ request('search') }}" 
                               placeholder="البحث بالعنوان أو الوصف">
                    </div>
                    <div class="col-md-4">
                        <select name="project" class="form-select">
                            <option value="">جميع المشاريع</option>
                            @foreach($projects as $route => $name)
                                <option value="{{ $route }}" {{ request('project') == $route ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> بحث
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Videos Table -->
        <div class="card">
            <div class="card-body">
                @if($videos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المشروع</th>
                                    <th>العنوان</th>
                                    <th>الوصف</th>
                                    <th>المدة</th>
                                    <th>الترتيب</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($videos as $video)
                                    <tr>
                                        <td>{{ $video->id }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $video->project_name }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $video->title }}</strong>
                                            @if($video->video_type)
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fab fa-{{ $video->video_type === 'youtube' ? 'youtube text-danger' : 'vimeo text-primary' }}"></i>
                                                    {{ $video->video_type === 'youtube' ? 'YouTube' : 'Vimeo' }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ Str::limit($video->description ?? 'لا يوجد وصف', 50) }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($video->duration)
                                                <span class="badge bg-secondary">
                                                    <i class="far fa-clock"></i> {{ $video->duration }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $video->order }}</td>
                                        <td>
                                            @if($video->is_active)
                                                <span class="badge bg-success">نشط</span>
                                            @else
                                                <span class="badge bg-secondary">معطل</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.videos.edit', $video) }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   title="تعديل">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.videos.destroy', $video) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الفيديو؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $videos->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-video fa-3x text-muted mb-3"></i>
                        <p class="text-muted">لا توجد فيديوهات حتى الآن.</p>
                        <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة فيديو جديد
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
