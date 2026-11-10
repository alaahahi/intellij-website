<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $companyName }} — نظام الحساب</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/system-account.css', 'resources/js/system-account/main.jsx'])
</head>
<body class="sa-body">
    <div
        id="system-account-root"
        data-slug="{{ $slug }}"
        data-company-name="{{ $companyName }}"
        data-unlocked="{{ $unlocked ? '1' : '0' }}"
        data-base-url="{{ url('/system-account/'.$slug) }}"
    ></div>
</body>
</html>
