<!DOCTYPE html>
<html lang="{{ $htmlLang }}" dir="{{ $dir }}">
<head>
    <meta charset="utf-8">
    <title>{{ $t('title') }} — {{ $companyName }}</title>
    <style>
        :root {
            --ink: #111827;
            --muted: #6b7280;
            --line: #e5e7eb;
            --soft: #f9fafb;
            --green: #047857;
            --green-soft: #ecfdf5;
            --amber: #b45309;
            --amber-soft: #fffbeb;
        }
        * { box-sizing: border-box; }
        body {
            font-family: Tahoma, 'Segoe UI', 'Noto Kufi Arabic', Arial, sans-serif;
            font-size: 13px;
            color: var(--ink);
            margin: 0;
            background: #f3f4f6;
        }
        .page {
            max-width: 920px;
            margin: 24px auto;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 28px 32px 36px;
            box-shadow: 0 8px 24px rgba(17, 24, 39, 0.06);
        }
        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            margin-bottom: 18px;
        }
        .actions button, .actions a {
            background: var(--ink);
            color: #fff;
            border: 0;
            border-radius: 8px;
            padding: 9px 16px;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }
        .actions a.secondary { background: #374151; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding-bottom: 18px;
            border-bottom: 2px solid var(--green);
            margin-bottom: 22px;
        }
        .brand {
            font-size: 22px;
            font-weight: 700;
            color: var(--green);
            margin: 0 0 4px;
        }
        .subtitle { color: var(--muted); margin: 0; }
        .meta {
            text-align: end;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }
        .meta strong { color: var(--ink); }
        .section { margin-top: 22px; }
        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }
        .section-title h2 {
            margin: 0;
            font-size: 16px;
            color: var(--green);
        }
        .pill {
            display: inline-block;
            background: var(--green-soft);
            color: var(--green);
            border-radius: 999px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 10px;
        }
        table.data th {
            background: #064e3b;
            color: #fff;
            text-align: start;
            padding: 10px 12px;
            font-size: 11px;
            font-weight: 600;
        }
        table.data td {
            padding: 9px 12px;
            border-bottom: 1px solid var(--line);
            vertical-align: middle;
            text-align: start;
        }
        table.data tr:nth-child(even) td { background: var(--soft); }
        table.data tr:last-child td { border-bottom: none; }
        .num { font-variant-numeric: tabular-nums; direction: ltr; unicode-bidi: embed; }
        .empty {
            text-align: center;
            color: var(--muted);
            padding: 18px;
            border: 1px dashed var(--line);
            border-radius: 10px;
            background: var(--soft);
        }
        .settlement {
            margin: 26px 0 8px;
            border: 1px solid #a7f3d0;
            background: linear-gradient(180deg, #ecfdf5 0%, #ffffff 100%);
            border-radius: 12px;
            padding: 16px 18px;
        }
        .settlement h2 {
            margin: 0 0 12px;
            font-size: 15px;
            color: var(--green);
            text-align: center;
        }
        .settlement-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .stat {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }
        .stat .label { color: var(--muted); font-size: 11px; margin-bottom: 6px; }
        .stat .value { font-size: 18px; font-weight: 700; direction: ltr; unicode-bidi: embed; }
        .stat.remaining { border-color: #fcd34d; background: var(--amber-soft); }
        .stat.remaining .value { color: var(--amber); }
        .stat.cars .value { color: var(--ink); }
        .stat.transfers .value { color: var(--green); }
        .total-row td { font-weight: 700; background: #f0fdf4 !important; }
        .footer {
            margin-top: 28px;
            padding-top: 14px;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 11px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
        }
        .footer a { color: var(--green); text-decoration: none; font-weight: 600; }
        @media print {
            body { background: #fff; }
            .page {
                margin: 0;
                border: none;
                border-radius: 0;
                box-shadow: none;
                max-width: none;
                padding: 8mm 10mm;
            }
            .actions { display: none !important; }
            table.data tr:nth-child(even) td { background: transparent; }
            .settlement { break-inside: avoid; }
            .section { break-inside: avoid; }
        }
        @media (max-width: 700px) {
            .page { margin: 0; border-radius: 0; }
            .settlement-grid { grid-template-columns: 1fr; }
            .header { flex-direction: column; }
            .meta { text-align: start; }
        }
    </style>
</head>
<body>
@php
    $fmt = fn ($n) => number_format((float) $n, 2);
    $carsTotal = (float) ($stats['amount_total'] ?? 0);
    $transferTotal = (float) ($stats['transfer_total'] ?? 0);
    $remaining = (float) ($stats['remaining'] ?? ($carsTotal - $transferTotal));
    $carsCount = (float) ($stats['cars_total'] ?? 0);
@endphp
<div class="page">
    <div class="actions">
        <button type="button" onclick="window.print()">{{ $t('print') }}</button>
        <a class="secondary" href="{{ url('/system-account/'.$slug) }}">{{ $t('back') }}</a>
    </div>

    <div class="header">
        <div>
            <h1 class="brand">{{ $companyName }}</h1>
            <p class="subtitle">{{ $t('subtitle') }}</p>
        </div>
        <div class="meta">
            <div><strong>{{ $t('date') }}:</strong> {{ now()->format('Y-m-d H:i') }}</div>
            <div><strong>{{ $t('cars_count') }}:</strong> <span class="num">{{ number_format($carsCount) }}</span></div>
            <div><strong>{{ $t('remittances_count') }}:</strong> <span class="num">{{ $remittances->count() }}</span></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">
            <h2>{{ $t('cars') }}</h2>
            <span class="pill">{{ $t('cars_rows', ['count' => $batches->count(), 'total' => $fmt($carsTotal)]) }}</span>
        </div>
        @if ($batches->isEmpty())
            <div class="empty">{{ $t('no_cars') }}</div>
        @else
            <table class="data">
                <thead>
                    <tr>
                        <th style="width:48px">{{ $t('col_num') }}</th>
                        <th>{{ $t('col_car_type') }}</th>
                        <th>{{ $t('col_date') }}</th>
                        <th>{{ $t('col_count') }}</th>
                        <th>{{ $t('col_unit_price') }}</th>
                        <th>{{ $t('col_total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($batches as $i => $batch)
                        <tr>
                            <td class="num">{{ $i + 1 }}</td>
                            <td>{{ $batch->car_type ?: '—' }}</td>
                            <td class="num">{{ $batch->entry_date ?: '—' }}</td>
                            <td class="num">{{ number_format((int) $batch->cars_count) }}</td>
                            <td class="num">{{ $fmt($batch->unit_price) }}</td>
                            <td class="num"><strong>{{ $fmt($batch->total_amount) }}</strong></td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3">{{ $t('total') }}</td>
                        <td class="num">{{ number_format($carsCount) }}</td>
                        <td></td>
                        <td class="num">{{ $fmt($carsTotal) }}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>

    <div class="settlement">
        <h2>{{ $t('settlement') }}</h2>
        <div class="settlement-grid">
            <div class="stat cars">
                <div class="label">{{ $t('cars_total') }}</div>
                <div class="value">{{ $fmt($carsTotal) }}</div>
            </div>
            <div class="stat transfers">
                <div class="label">{{ $t('transfers_total') }}</div>
                <div class="value">{{ $fmt($transferTotal) }}</div>
            </div>
            <div class="stat remaining">
                <div class="label">{{ $t('remaining') }}</div>
                <div class="value">{{ $fmt($remaining) }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">
            <h2>{{ $t('remittances') }}</h2>
            <span class="pill">{{ $t('rem_rows', ['count' => $remittances->count(), 'total' => $fmt($transferTotal)]) }}</span>
        </div>
        @if ($remittances->isEmpty())
            <div class="empty">{{ $t('no_remittances') }}</div>
        @else
            <table class="data">
                <thead>
                    <tr>
                        <th style="width:48px">{{ $t('col_num') }}</th>
                        <th>{{ $t('col_amount') }}</th>
                        <th>{{ $t('col_transfer_date') }}</th>
                        <th>{{ $t('col_note') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($remittances as $i => $rem)
                        <tr>
                            <td class="num">{{ $i + 1 }}</td>
                            <td class="num"><strong>{{ $fmt($rem->amount) }}</strong></td>
                            <td class="num">{{ $rem->transfer_date ?: '—' }}</td>
                            <td>{{ $rem->note ?: '—' }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>{{ $t('total') }}</td>
                        <td class="num">{{ $fmt($transferTotal) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>

    <div class="footer">
        <span>{{ $t('system') }} — {{ $slug }}</span>
        <a href="https://wa.me/9647511077812" target="_blank" rel="noopener">{{ $t('vendor') }}</a>
    </div>
</div>
<script>
    window.addEventListener('load', function () {
        var params = new URLSearchParams(window.location.search);
        if (params.get('autoprint') !== '0') {
            setTimeout(function () { window.print(); }, 350);
        }
    });
</script>
</body>
</html>
