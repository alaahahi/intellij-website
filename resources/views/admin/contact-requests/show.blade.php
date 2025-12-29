@extends('admin.layout')

@section('title', 'تفاصيل الطلب')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5">تفاصيل الطلب #{{ $contactRequest->id }}</h1>
            <a href="{{ route('admin.contact-requests.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i> العودة للقائمة
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Request Details -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">معلومات الطلب</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">الاسم:</div>
                            <div class="col-md-8">{{ $contactRequest->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">البريد الإلكتروني:</div>
                            <div class="col-md-8">
                                <a href="mailto:{{ $contactRequest->email }}">{{ $contactRequest->email }}</a>
                            </div>
                        </div>
                        @if($contactRequest->phone)
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">الجوال:</div>
                            <div class="col-md-8">
                                <a href="tel:{{ $contactRequest->phone }}">{{ $contactRequest->phone }}</a>
                            </div>
                        </div>
                        @endif
                        @if($contactRequest->project_type)
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">نوع المشروع:</div>
                            <div class="col-md-8">{{ $contactRequest->project_type }}</div>
                        </div>
                        @endif
                        @if($contactRequest->subject)
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">الموضوع:</div>
                            <div class="col-md-8">{{ $contactRequest->subject }}</div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">الرسالة:</div>
                            <div class="col-md-8">
                                <div class="border rounded p-3 bg-light">
                                    {{ $contactRequest->message }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">تاريخ الإرسال:</div>
                            <div class="col-md-8">{{ $contactRequest->created_at->format('Y-m-d H:i:s') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status and Actions -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">الحالة</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @if($contactRequest->status === 'new')
                                <span class="badge bg-warning fs-6">جديد</span>
                            @elseif($contactRequest->status === 'read')
                                <span class="badge bg-info fs-6">مقروء</span>
                            @elseif($contactRequest->status === 'replied')
                                <span class="badge bg-success fs-6">تم الرد</span>
                            @else
                                <span class="badge bg-secondary fs-6">مؤرشف</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.contact-requests.update-status', $contactRequest) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="status" class="form-label">تغيير الحالة:</label>
                                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                                    <option value="new" {{ $contactRequest->status === 'new' ? 'selected' : '' }}>جديد</option>
                                    <option value="read" {{ $contactRequest->status === 'read' ? 'selected' : '' }}>مقروء</option>
                                    <option value="replied" {{ $contactRequest->status === 'replied' ? 'selected' : '' }}>تم الرد</option>
                                    <option value="archived" {{ $contactRequest->status === 'archived' ? 'selected' : '' }}>مؤرشف</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">إجراءات خطيرة</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.contact-requests.destroy', $contactRequest) }}" 
                              method="POST" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> حذف الطلب
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

