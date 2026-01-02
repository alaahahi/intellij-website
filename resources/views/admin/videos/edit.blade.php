@extends('admin.layout')

@section('title', 'تعديل فيديو')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5">تعديل فيديو</h1>
            <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i> العودة للقائمة
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.videos.update', $video) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="project_route" class="form-label">المشروع <span class="text-danger">*</span></label>
                            <select name="project_route" id="project_route" class="form-select @error('project_route') is-invalid @enderror" required>
                                <option value="">اختر المشروع</option>
                                @foreach($projects as $route => $name)
                                    <option value="{{ $route }}" {{ old('project_route', $video->project_route) == $route ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_route')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="order" class="form-label">الترتيب</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" 
                                   value="{{ old('order', $video->order) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">الفيديوهات ذات الترتيب الأقل تظهر أولاً</small>
                        </div>

                        <div class="col-12">
                            <label for="title" class="form-label">عنوان الفيديو <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $video->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $video->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="video_url" class="form-label">رابط الفيديو <span class="text-danger">*</span></label>
                            <input type="url" name="video_url" id="video_url" 
                                   class="form-control @error('video_url') is-invalid @enderror" 
                                   value="{{ old('video_url', $video->video_url) }}" 
                                   placeholder="https://www.youtube.com/watch?v=VIDEO_ID أو https://vimeo.com/VIDEO_ID" 
                                   required>
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                يدعم YouTube و Vimeo<br>
                                أمثلة: 
                                <code>https://www.youtube.com/watch?v=VIDEO_ID</code> أو 
                                <code>https://youtu.be/VIDEO_ID</code> أو 
                                <code>https://vimeo.com/VIDEO_ID</code>
                            </small>
                        </div>

                        <div class="col-md-6">
                            <label for="thumbnail" class="form-label">رابط الصورة المصغرة (اختياري)</label>
                            <input type="url" name="thumbnail" id="thumbnail" 
                                   class="form-control @error('thumbnail') is-invalid @enderror" 
                                   value="{{ old('thumbnail', $video->thumbnail) }}" 
                                   placeholder="https://example.com/thumbnail.jpg">
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">إذا لم يتم تحديدها، سيتم استخدام الصورة الافتراضية من YouTube/Vimeo</small>
                        </div>

                        <div class="col-md-6">
                            <label for="duration" class="form-label">مدة الفيديو (اختياري)</label>
                            <input type="text" name="duration" id="duration" 
                                   class="form-control @error('duration') is-invalid @enderror" 
                                   value="{{ old('duration', $video->duration) }}" 
                                   placeholder="مثال: 10:30">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                                       value="1" {{ old('is_active', $video->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    تفعيل الفيديو
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> حفظ التغييرات
                            </button>
                            <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> إلغاء
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

