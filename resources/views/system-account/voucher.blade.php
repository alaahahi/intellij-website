<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $title }} #{{ $remittance->id }}</title>
    <style>
        body { font-family: DejaVu Sans, 'Noto Kufi Arabic', sans-serif; font-size: 13px; color: #111827; margin: 32px; }
        h1 { font-size: 22px; margin: 0; }
        .muted { color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th { background: #111827; color: #fff; text-align: right; padding: 8px; font-size: 11px; }
        td { padding: 8px; border-bottom: 1px solid #e5e7eb; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 4px; background: #f3f4f6; font-size: 11px; }
        .actions { margin-bottom: 16px; }
        .actions button { background: #111827; color: #fff; border: 0; border-radius: 6px; padding: 8px 14px; cursor: pointer; }
        @media print { .actions { display: none; } body { margin: 12px; } }
    </style>
</head>
<body>
    <div class="actions"><button onclick="window.print()">طباعة</button></div>
    <table style="margin-top:0">
        <tr>
            <td style="border:none">
                <h1>{{ $companyName }}</h1>
                <div class="muted">{{ $title }}</div>
            </td>
            <td style="border:none; text-align:left">
                <strong>{{ $title }} #{{ $remittance->id }}</strong><br>
                <span class="muted">التاريخ: {{ $remittance->transfer_date ?: now()->format('d/m/Y') }}</span><br>
                <span class="badge">{{ $type === 'receipt' ? 'قبض' : 'دفع' }}</span>
            </td>
        </tr>
    </table>
    <table>
        <tr><th>البيان</th><th>التفاصيل</th></tr>
        <tr><td>مبلغ {{ $type === 'receipt' ? 'القبض' : 'الدفع' }}</td><td><strong>{{ number_format((float) $remittance->amount, 2) }}</strong></td></tr>
        <tr><td>تاريخ الحوالة</td><td>{{ $remittance->transfer_date ?: '—' }}</td></tr>
        <tr><td>الملاحظة</td><td>{{ $remittance->note ?: '—' }}</td></tr>
        <tr><td>مجموع السيارات (الحساب)</td><td>{{ number_format((float) ($stats['amount_total'] ?? 0), 2) }}</td></tr>
        <tr><td>مجموع الحوالات</td><td>{{ number_format((float) ($stats['transfer_total'] ?? 0), 2) }}</td></tr>
    </table>
    <p class="muted" style="margin-top:28px">نظام الحساب — {{ $slug }}</p>
    <script>window.addEventListener('load', function () { setTimeout(function () { window.print(); }, 300); });</script>
</body>
</html>