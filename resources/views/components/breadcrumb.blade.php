<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <ul class="breadcrumb-animation">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $title ?? 'الصفحة' }}</h3>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ route('home') }}" itemprop="item">
                    <span itemprop="name">الرئيسية</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item active text-primary" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">{{ $title ?? 'الصفحة' }}</span>
                <meta itemprop="position" content="2" />
            </li>
        </ol>    
    </div>
</div>
<!-- Header End -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "الرئيسية",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "{{ $title ?? 'الصفحة' }}",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>
