<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Velora — Instagram</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d, #f56040, #f77737, #fcaf45, #ffdc80);
            background-size: 400% 400%;
            animation: igGradient 8s ease infinite;
            overflow: hidden;
        }
        @keyframes igGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .card {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            max-width: 380px;
            width: 90%;
            animation: fadeUp 0.6s ease;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .icon-ring {
            width: 88px;
            height: 88px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s ease-in-out infinite;
        }
        .icon-ring i {
            font-size: 2.5rem;
            color: #fff;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.06); }
        }
        h1 {
            font-size: 1.75rem;
            color: #262626;
            margin-bottom: 0.5rem;
        }
        p {
            color: #8e8e8e;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .spinner {
            width: 36px;
            height: 36px;
            border: 3px solid #efefef;
            border-top-color: #c13584;
            border-radius: 50%;
            margin: 0 auto 1rem;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        a.fallback {
            color: #c13584;
            font-size: 0.875rem;
            text-decoration: none;
        }
        a.fallback:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-ring">
            <i class="fab fa-instagram"></i>
        </div>
        <h1>Velora</h1>
        <p>جاري تحويلك إلى Instagram...</p>
        <div class="spinner"></div>
        <a class="fallback" href="https://www.instagram.com/velora.iq.store?igsh=Y2h5OWVha2VvcDJ6&utm_source=qr">
            اضغط هنا إذا لم يتم التحويل
        </a>
    </div>
    <script>
        setTimeout(function () {
            window.location.href = 'https://www.instagram.com/velora.iq.store?igsh=Y2h5OWVha2VvcDJ6&utm_source=qr';
        }, 1200);
    </script>
</body>
</html>
