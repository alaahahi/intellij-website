@extends('admin.layout')

@section('title', 'لوحة التحكم - Vue.js')

@section('content')
<!-- Vue App Container -->
<div id="visits-dashboard-app"></div>
@endsection

@push('scripts')
<!-- Vue 3 -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Main App JS -->
<script src="{{ asset('js/visits-dashboard.js') }}"></script>
<script>
    // Highlight active menu item
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const menuItems = document.querySelectorAll('.sidebar-menu a');
        menuItems.forEach(item => {
            if (item.getAttribute('href') && currentPath.includes(item.getAttribute('href').replace('{{ url("") }}', ''))) {
                item.classList.add('active');
            }
        });
    });
</script>
@endpush
