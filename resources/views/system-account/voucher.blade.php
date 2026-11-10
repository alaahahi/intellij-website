<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $title }} #{{ $car->id }}</title>
    <style>
        body { font-family: DejaVu Sans, 'Noto Kufi Arabic', sans-serif; font-size: 13px; color: #111827; margin: 32px; }
        h1 { font-size: 22px; margin: 0; }
        .muted { color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th { background: #111827; color: #fff; text-align: right; padding: 8px; font-size: 11px; }
        td { padding: 8px; border-bottom: 1px solid #e5e7eb; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 4px; background: #f3f4f6; font-size: 11px; }
        .actions { margin-bottom: 16px; }
        .actions button {
            background: #111827; color: #fff; border: 0; border-radius: 6px;
            padding: 8px 14px; cursor: pointer; font-size: 13px;
        }
        @media print { .actions { display: none; } body { margin: 12px; } }
    </style>
</head>
<body>
    <div class="actions">
        <button onclick="window.print()">طباعة</button>
    </div>

    <table style="margin-top:0">
        <tr>
            <td style="border:none">
                <h1>{{ $companyName }}</h1>
                <div class="muted">{{ $title }}</div>
            </td>
            <td style="border:none; text-align:left">
                <strong>{{ $title }} #{{ $car->id }}</strong><br>
                <span class="muted">التاريخ: {{ $car->transfer_date ?: $car->entry_date ?: now()->format('d/m/Y') }}</span><br>
                <span class="badge">{{ $type === 'receipt' ? 'قبض' : 'دفع' }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>البيان</th>
            <th>التفاصيل</th>
        </tr>
        <tr>
            <td>نوع السيارة / العملية</td>
            <td>{{ $car->car_type }}</td>
        </tr>
        <tr>
            <td>عدد السيارات</td>
            <td>{{ number_format((int) $car->cars_count) }}</td>
        </tr>
        <tr>
            <td>سعر الوحدة</td>
            <td>${{ number_format((float) $car->unit_price, 2) }}</td>
        </tr>
        <tr>
            <td>المجموع الكلي</td>
            <td>${{ number_format((float) $car->total_amount, 2) }}</td>
        </tr>
        <tr>
            <td>مبلغ {{ $type === 'receipt' ? 'القبض' : 'الدفع' }}</td>
            <td><strong>${{ number_format((float) ($car->transfer_amount ?? 0), 2) }}</strong></td>
        </tr>
        <tr>
            <td>ملاحظة الحوالة</td>
            <td>{{ $car->transfer_note ?: '—' }}</td>
        </tr>
    </table>

    <p class="muted" style="margin-top:28px">تم إنشاء هذا الوصول من نظام الحساب — {{ $slug }}</p>

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () { window.print(); }, 300);
        });
    </script>
</body>
</html>
