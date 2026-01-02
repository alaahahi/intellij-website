@php
    // Component لعرض الفيديوهات التعليمية في أي صفحة مشروع
    // الاستخدام: @include('components.videos-section', ['projectRoute' => 'accounting-system'])
    
    $projectVideos = \App\Models\Video::where('project_route', $projectRoute ?? 'accounting-system')
        ->where('is_active', true)
        ->orderBy('order')
        ->get();
@endphp

@if($projectVideos->count() > 0 || ($showEmpty ?? true))
    <div class="row g-5 mb-5">
        <div class="col-12">
            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h3 class="mb-3">{{ $sectionTitle ?? 'الفيديوهات التعليمية' }}</h3>
                <p class="text-muted">{{ $sectionDescription ?? 'تعلم كيفية استخدام البرنامج من خلال سلسلة الفيديوهات التعليمية الشاملة' }}</p>
            </div>
            
            @if($projectVideos->count() > 0)
                <div class="row g-4">
                    @foreach($projectVideos as $index => $video)
                        @php
                            $hasVideo = !empty($video->embed_url);
                            $delay = 0.1 + ($index * 0.2);
                        @endphp
                        
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                            <div class="card border-0 shadow-sm h-100 video-card">
                                <div class="position-relative" style="padding-top: 56.25%; overflow: hidden; background: linear-gradient(135deg, rgba(102, 16, 242, 0.1) 0%, rgba(247, 71, 128, 0.1) 100%);">
                                    @if($hasVideo && $video->thumbnail_url)
                                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;">
                                    @endif
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3); cursor: pointer;" 
                                         @if($hasVideo) data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('{{ $video->embed_url }}', '{{ $video->video_type }}')" @endif>
                                        <div class="text-center">
                                            <i class="fas fa-play-circle text-white" style="font-size: 4rem; opacity: 0.9; text-shadow: 0 2px 10px rgba(0,0,0,0.5);"></i>
                                            @if($video->duration)
                                                <div class="mt-2">
                                                    <span class="badge bg-dark bg-opacity-75">{{ $video->duration }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->title }}</h5>
                                    <p class="card-text text-muted small">{{ $video->description }}</p>
                                    @if(!$hasVideo)
                                        <span class="badge bg-secondary">قريباً</span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>متاح
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center mt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <p class="text-muted mb-3">سيتم إضافة الفيديوهات التعليمية قريباً</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill py-2 px-4">
                        <i class="fas fa-bell me-2"></i>إشعارني عند إضافة الفيديوهات
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoFrame" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function loadVideo(embedUrl, videoType) {
            const iframe = document.getElementById('videoFrame');
            if (videoType === 'youtube') {
                iframe.src = embedUrl + '?autoplay=1&rel=0&modestbranding=1&showinfo=0';
            } else if (videoType === 'vimeo') {
                iframe.src = embedUrl + '?autoplay=1';
            } else {
                iframe.src = embedUrl;
            }
        }
        
        // إيقاف الفيديو عند إغلاق الـ modal
        document.addEventListener('DOMContentLoaded', function() {
            const videoModal = document.getElementById('videoModal');
            if (videoModal) {
                videoModal.addEventListener('hidden.bs.modal', function () {
                    const videoFrame = document.getElementById('videoFrame');
                    if (videoFrame) {
                        videoFrame.src = '';
                    }
                });
            }
        });
    </script>
@endif

