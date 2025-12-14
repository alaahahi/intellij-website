@extends('layouts.app')

@section('title', 'إحصائيات الزيارات - لوحة التحكم')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5">إحصائيات الزيارات</h1>
            <a href="{{ route('admin.visits.stats') }}" class="btn btn-primary" target="_blank">API Stats</a>
        </div>

        <!-- إحصائيات عامة -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الزيارات</h5>
                        <h2 class="mb-0">{{ number_format($stats['total']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">زيارات اليوم</h5>
                        <h2 class="mb-0">{{ number_format($stats['today']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">زيارات هذا الأسبوع</h5>
                        <h2 class="mb-0">{{ number_format($stats['this_week']) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">زيارات هذا الشهر</h5>
                        <h2 class="mb-0">{{ number_format($stats['this_month']) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- إحصائيات حسب المصدر -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">الزيارات حسب المصدر</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>المصدر</th>
                                    <th>عدد الزيارات</th>
                                    <th>النسبة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sources as $sourceItem)
                                <tr>
                                    <td>
                                        @if($sourceItem->source == 'google')
                                            <i class="fab fa-google text-danger"></i> Google
                                        @elseif($sourceItem->source == 'facebook')
                                            <i class="fab fa-facebook text-primary"></i> Facebook
                                        @elseif($sourceItem->source == 'direct')
                                            <i class="fas fa-link"></i> مباشر
                                        @else
                                            {{ ucfirst($sourceItem->source) }}
                                        @endif
                                    </td>
                                    <td>{{ number_format($sourceItem->total) }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar" 
                                                 style="width: {{ ($sourceItem->total / $stats['total']) * 100 }}%">
                                                {{ number_format(($sourceItem->total / $stats['total']) * 100, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- إحصائيات حسب الصفحة -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">أكثر الصفحات زيارة</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>الصفحة</th>
                                    <th>عدد الزيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $pageItem)
                                <tr>
                                    <td>{{ $pageItem->page ?: '/' }}</td>
                                    <td>{{ number_format($pageItem->total) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- قائمة الزيارات -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">سجل الزيارات</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.visits.index') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <select name="source" class="form-select">
                                <option value="">جميع المصادر</option>
                                <option value="google" {{ request('source') == 'google' ? 'selected' : '' }}>Google</option>
                                <option value="facebook" {{ request('source') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="direct" {{ request('source') == 'direct' ? 'selected' : '' }}>مباشر</option>
                                <option value="other" {{ request('source') == 'other' ? 'selected' : '' }}>أخرى</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="من تاريخ">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" placeholder="إلى تاريخ">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">بحث</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>التاريخ والوقت</th>
                                <th>المصدر</th>
                                <th>الصفحة</th>
                                <th>IP</th>
                                <th>الجهاز</th>
                                <th>المتصفح</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($visits as $visit)
                            <tr>
                                <td>{{ $visit->id }}</td>
                                <td>{{ $visit->visited_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    @if($visit->source == 'google')
                                        <span class="badge bg-danger"><i class="fab fa-google"></i> Google</span>
                                    @elseif($visit->source == 'facebook')
                                        <span class="badge bg-primary"><i class="fab fa-facebook"></i> Facebook</span>
                                    @elseif($visit->source == 'direct')
                                        <span class="badge bg-secondary"><i class="fas fa-link"></i> مباشر</span>
                                    @else
                                        <span class="badge bg-info">{{ ucfirst($visit->source) }}</span>
                                    @endif
                                </td>
                                <td>{{ $visit->page ?: '/' }}</td>
                                <td>{{ $visit->ip_address }}</td>
                                <td>
                                    @if($visit->device == 'mobile')
                                        <i class="fas fa-mobile-alt"></i> Mobile
                                    @elseif($visit->device == 'tablet')
                                        <i class="fas fa-tablet-alt"></i> Tablet
                                    @else
                                        <i class="fas fa-desktop"></i> Desktop
                                    @endif
                                </td>
                                <td>{{ ucfirst($visit->browser) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">لا توجد زيارات مسجلة</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $visits->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
