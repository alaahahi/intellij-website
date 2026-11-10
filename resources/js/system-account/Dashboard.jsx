import React, { useMemo, useRef, useState } from 'react';
import { Card, CardHeader, Field, PageHeader, StatCard, TextInput, ToolbarButton } from './ui';

const emptyForm = {
    car_type: '',
    entry_date: '',
    cars_count: '',
    unit_price: '',
    transfer_amount: '',
    transfer_date: '',
    transfer_note: '',
};

function money(n) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 2,
    }).format(Number(n || 0));
}

export default function Dashboard({
    companyName,
    cars,
    stats,
    loading,
    onRefresh,
    onAdd,
    onDelete,
    onImport,
    onExport,
    onLock,
    baseUrl,
}) {
    const [form, setForm] = useState(emptyForm);
    const [search, setSearch] = useState('');
    const [saving, setSaving] = useState(false);
    const [importing, setImporting] = useState(false);
    const fileRef = useRef(null);

    const filtered = useMemo(() => {
        const q = search.trim().toLowerCase();
        if (!q) return cars;
        return cars.filter((c) =>
            [c.car_type, c.entry_date, c.transfer_note, c.transfer_date]
                .filter(Boolean)
                .some((v) => String(v).toLowerCase().includes(q)),
        );
    }, [cars, search]);

    const set = (key) => (e) => setForm((f) => ({ ...f, [key]: e.target.value }));

    const submit = async (e) => {
        e.preventDefault();
        setSaving(true);
        try {
            await onAdd({
                ...form,
                cars_count: Number(form.cars_count || 0),
                unit_price: Number(form.unit_price || 0),
                transfer_amount: form.transfer_amount === '' ? null : Number(form.transfer_amount),
            });
            setForm(emptyForm);
        } finally {
            setSaving(false);
        }
    };

    const handleImport = async (e) => {
        const file = e.target.files?.[0];
        if (!file) return;
        setImporting(true);
        try {
            await onImport(file);
        } finally {
            setImporting(false);
            e.target.value = '';
        }
    };

    return (
        <div className="mx-auto max-w-7xl px-4 py-6">
            <PageHeader
                title={companyName}
                subtitle="حساب السيارات والحوالات"
                actions={
                    <>
                        <ToolbarButton onClick={onRefresh} disabled={loading}>تحديث</ToolbarButton>
                        <ToolbarButton onClick={() => fileRef.current?.click()} disabled={importing}>
                            {importing ? 'جاري الاستيراد...' : 'استيراد Excel'}
                        </ToolbarButton>
                        <ToolbarButton onClick={onExport}>تصدير Excel</ToolbarButton>
                        <ToolbarButton danger onClick={onLock}>قفل</ToolbarButton>
                        <input ref={fileRef} type="file" accept=".xlsx,.xls,.csv" className="hidden" onChange={handleImport} />
                    </>
                }
            />

            <div className="mb-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <StatCard label="مجموع السيارات" value={Number(stats.cars_total || 0).toLocaleString('en-US')} />
                <StatCard label="المجموع الكلي" value={money(stats.amount_total)} />
                <StatCard label="مجموع الحوالات" value={money(stats.transfer_total)} tone="green" />
                <StatCard label="المتبقي (حوالات − كلي)" value={money(stats.balance_with_transfers)} tone="orange" />
            </div>

            <Card className="mb-5">
                <CardHeader title="إضافة سريعة" subtitle="مثل إدخال صف في الإكسل" />
                <form onSubmit={submit} className="grid gap-3 p-4 md:grid-cols-3 lg:grid-cols-4">
                    <Field label="نوع السيارة">
                        <TextInput value={form.car_type} onChange={set('car_type')} required />
                    </Field>
                    <Field label="التاريخ">
                        <TextInput value={form.entry_date} onChange={set('entry_date')} placeholder="20/8/2026" />
                    </Field>
                    <Field label="عدد السيارات">
                        <TextInput type="number" min="0" value={form.cars_count} onChange={set('cars_count')} required />
                    </Field>
                    <Field label="سعر السيارة $">
                        <TextInput type="number" min="0" step="0.01" value={form.unit_price} onChange={set('unit_price')} required />
                    </Field>
                    <Field label="مبلغ الحوالة">
                        <TextInput type="number" min="0" step="0.01" value={form.transfer_amount} onChange={set('transfer_amount')} />
                    </Field>
                    <Field label="تاريخ الحوالة">
                        <TextInput value={form.transfer_date} onChange={set('transfer_date')} placeholder="27/8/2026" />
                    </Field>
                    <Field label="ملاحظة الحوالة">
                        <TextInput value={form.transfer_note} onChange={set('transfer_note')} />
                    </Field>
                    <div className="flex items-end">
                        <ToolbarButton primary className="h-9 w-full justify-center" disabled={saving}>
                            {saving ? 'جاري الحفظ...' : 'إضافة'}
                        </ToolbarButton>
                    </div>
                </form>
            </Card>

            <Card>
                <CardHeader
                    title="قائمة السيارات"
                    subtitle={`${filtered.length} صف`}
                    actions={
                        <TextInput
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                            placeholder="بحث..."
                            className="w-48"
                        />
                    }
                />
                <div className="overflow-x-auto">
                    <table className="min-w-full text-sm">
                        <thead className="bg-zinc-50 text-[11px] text-zinc-600">
                            <tr>
                                <th className="px-3 py-2 text-start">#</th>
                                <th className="px-3 py-2 text-start">نوع السيارة</th>
                                <th className="px-3 py-2 text-start">التاريخ</th>
                                <th className="px-3 py-2 text-start">العدد</th>
                                <th className="px-3 py-2 text-start">السعر</th>
                                <th className="px-3 py-2 text-start">المجموع</th>
                                <th className="px-3 py-2 text-start">الحوالة</th>
                                <th className="px-3 py-2 text-start">تاريخ الحوالة</th>
                                <th className="px-3 py-2 text-start">ملاحظة</th>
                                <th className="px-3 py-2 text-start">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            {filtered.map((car, idx) => (
                                <tr key={car.id} className="border-t border-zinc-100 hover:bg-zinc-50/80">
                                    <td className="px-3 py-2">{idx + 1}</td>
                                    <td className="px-3 py-2 font-medium">{car.car_type}</td>
                                    <td className="px-3 py-2 whitespace-nowrap">{car.entry_date || '—'}</td>
                                    <td className="px-3 py-2">{car.cars_count}</td>
                                    <td className="px-3 py-2">{money(car.unit_price)}</td>
                                    <td className="px-3 py-2 font-semibold">{money(car.total_amount)}</td>
                                    <td className="px-3 py-2 text-green-700">{car.transfer_amount != null ? money(car.transfer_amount) : '—'}</td>
                                    <td className="px-3 py-2 whitespace-nowrap">{car.transfer_date || '—'}</td>
                                    <td className="max-w-[220px] truncate px-3 py-2 text-zinc-500" title={car.transfer_note || ''}>
                                        {car.transfer_note || '—'}
                                    </td>
                                    <td className="px-3 py-2">
                                        <div className="flex flex-wrap gap-1">
                                            <a href={`${baseUrl}/vouchers/${car.id}/receipt`} target="_blank" rel="noreferrer">
                                                <ToolbarButton small>قبض</ToolbarButton>
                                            </a>
                                            <a href={`${baseUrl}/vouchers/${car.id}/payment`} target="_blank" rel="noreferrer">
                                                <ToolbarButton small>دفع</ToolbarButton>
                                            </a>
                                            <ToolbarButton small danger onClick={() => onDelete(car.id)}>
                                                حذف
                                            </ToolbarButton>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                            {filtered.length === 0 && (
                                <tr>
                                    <td colSpan="10" className="px-3 py-8 text-center text-zinc-500">
                                        لا توجد صفوف بعد
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
            </Card>
        </div>
    );
}
