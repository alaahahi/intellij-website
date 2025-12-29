@extends('admin.layout')

@section('title', 'طلبات الاتصال')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5">طلبات الاتصال</h1>
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
                <form method="GET" action="{{ route('admin.contact-requests.index') }}" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" 
                               value="{{ request('search') }}" 
                               placeholder="البحث بالاسم، البريد الإلكتروني، أو الرسالة">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>جديد</option>
                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>مقروء</option>
                            <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>تم الرد</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>مؤرشف</option>
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

        <!-- Requests Table -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">قائمة الطلبات</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الجوال</th>
                                <th>الموضوع</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                            <tr class="{{ $request->status === 'new' ? 'table-warning' : '' }}">
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->phone ?? '-' }}</td>
                                <td>{{ $request->subject ?? '-' }}</td>
                                <td>
                                    @if($request->status === 'new')
                                        <span class="badge bg-warning">جديد</span>
                                    @elseif($request->status === 'read')
                                        <span class="badge bg-info">مقروء</span>
                                    @elseif($request->status === 'replied')
                                        <span class="badge bg-success">تم الرد</span>
                                    @else
                                        <span class="badge bg-secondary">مؤرشف</span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contact-requests.show', $request) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> عرض
                                        </a>
                                        <form action="{{ route('admin.contact-requests.destroy', $request) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">لا توجد طلبات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $requests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

