@extends('admin.layout')

@section('title', 'مسح الكاش')

@push('styles')
<style>
    .cache-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 20px;
    }
    .cache-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    }
    .cache-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }
    .cache-icon.cache { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .cache-icon.config { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .cache-icon.view { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .cache-icon.route { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .cache-icon.all { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
    
    .btn-clear {
        border-radius: 10px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-clear:hover {
        transform: scale(1.05);
    }
    
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .loading {
        display: none;
    }
    .loading.show {
        display: inline-block;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="display-5 mb-2">
                    <i class="fas fa-broom text-primary"></i> مسح الكاش
                </h1>
                <p class="text-muted">امسح أنواع مختلفة من الكاش لتحسين أداء الموقع</p>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Card -->
        <div class="stats-card">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3 class="mb-0" id="cache-size">-</h3>
                    <p class="mb-0">حجم الكاش</p>
                </div>
                <div class="col-md-4">
                    <h3 class="mb-0" id="views-count">-</h3>
                    <p class="mb-0">ملفات Views</p>
                </div>
                <div class="col-md-4">
                    <h3 class="mb-0" id="config-status">
                        <i class="fas fa-question-circle"></i>
                    </h3>
                    <p class="mb-0">حالة التكوين</p>
                </div>
            </div>
        </div>

        <!-- Cache Cards -->
        <div class="row">
            <!-- Cache Clear -->
            <div class="col-md-6 col-lg-4">
                <div class="card cache-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="cache-icon cache mx-auto">
                            <i class="fas fa-database text-white"></i>
                        </div>
                        <h5 class="card-title">كاش Laravel</h5>
                        <p class="card-text text-muted small">
                            يمسح كاش Laravel العام (Cache)
                        </p>
                        <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="type" value="cache">
                            <button type="submit" class="btn btn-primary btn-clear">
                                <span class="loading spinner-border spinner-border-sm me-2"></span>
                                <i class="fas fa-trash-alt me-2"></i>مسح
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Config Clear -->
            <div class="col-md-6 col-lg-4">
                <div class="card cache-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="cache-icon config mx-auto">
                            <i class="fas fa-cog text-white"></i>
                        </div>
                        <h5 class="card-title">كاش التكوين</h5>
                        <p class="card-text text-muted small">
                            يمسح كاش ملفات التكوين (Config)
                        </p>
                        <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="type" value="config">
                            <button type="submit" class="btn btn-primary btn-clear">
                                <span class="loading spinner-border spinner-border-sm me-2"></span>
                                <i class="fas fa-trash-alt me-2"></i>مسح
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- View Clear -->
            <div class="col-md-6 col-lg-4">
                <div class="card cache-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="cache-icon view mx-auto">
                            <i class="fas fa-eye text-white"></i>
                        </div>
                        <h5 class="card-title">كاش الـ Views</h5>
                        <p class="card-text text-muted small">
                            يمسح كاش ملفات Blade (Views)
                        </p>
                        <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="type" value="view">
                            <button type="submit" class="btn btn-primary btn-clear">
                                <span class="loading spinner-border spinner-border-sm me-2"></span>
                                <i class="fas fa-trash-alt me-2"></i>مسح
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Route Clear -->
            <div class="col-md-6 col-lg-4">
                <div class="card cache-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="cache-icon route mx-auto">
                            <i class="fas fa-route text-white"></i>
                        </div>
                        <h5 class="card-title">كاش الـ Routes</h5>
                        <p class="card-text text-muted small">
                            يمسح كاش ملفات Routes
                        </p>
                        <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="type" value="route">
                            <button type="submit" class="btn btn-primary btn-clear">
                                <span class="loading spinner-border spinner-border-sm me-2"></span>
                                <i class="fas fa-trash-alt me-2"></i>مسح
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Clear All -->
            <div class="col-md-6 col-lg-4">
                <div class="card cache-card h-100 border-danger">
                    <div class="card-body text-center p-4">
                        <div class="cache-icon all mx-auto">
                            <i class="fas fa-broom text-white"></i>
                        </div>
                        <h5 class="card-title text-danger">مسح الكل</h5>
                        <p class="card-text text-muted small">
                            يمسح جميع أنواع الكاش دفعة واحدة
                        </p>
                        <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من مسح جميع أنواع الكاش؟');">
                            @csrf
                            <input type="hidden" name="type" value="all">
                            <button type="submit" class="btn btn-danger btn-clear">
                                <span class="loading spinner-border spinner-border-sm me-2"></span>
                                <i class="fas fa-broom me-2"></i>مسح الكل
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    معلومات مهمة
                </h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li><strong>كاش Laravel:</strong> يخزن البيانات المؤقتة من قاعدة البيانات والاستعلامات</li>
                    <li><strong>كاش التكوين:</strong> يخزن ملفات التكوين المكشفة لتحسين الأداء</li>
                    <li><strong>كاش الـ Views:</strong> يخزن ملفات Blade المترجمة</li>
                    <li><strong>كاش الـ Routes:</strong> يخزن ملفات Routes المكشفة</li>
                    <li class="text-danger"><strong>تحذير:</strong> مسح الكاش قد يؤثر مؤقتاً على سرعة الموقع حتى يتم إعادة بناء الكاش</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // إظهار loading عند الضغط على الأزرار
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const btn = this.querySelector('.btn-clear');
            const loading = this.querySelector('.loading');
            if (loading) {
                loading.classList.add('show');
                btn.disabled = true;
            }
        });
    });

    // تحديث الإحصائيات
    function updateStats() {
        fetch('{{ route("admin.cache.info") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cache-size').textContent = data.cache_size || '0 KB';
                document.getElementById('views-count').textContent = data.views_count || '0';
                
                const configIcon = document.querySelector('#config-status i');
                if (data.config_cached) {
                    configIcon.className = 'fas fa-check-circle text-warning';
                    configIcon.title = 'مكشف';
                } else {
                    configIcon.className = 'fas fa-times-circle text-success';
                    configIcon.title = 'غير مكشف';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // تحديث الإحصائيات عند تحميل الصفحة
    updateStats();

    // تحديث الإحصائيات كل 30 ثانية
    setInterval(updateStats, 30000);
</script>
@endpush

