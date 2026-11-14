import React, { useEffect, useMemo, useRef, useState } from 'react';
import { Card, CardHeader, Modal, PageHeader, StatCard, TextInput, ToolbarButton } from './ui';
import { useI18n } from './i18n/I18nProvider';

const emptyBatch = { car_type: '', entry_date: '', cars_count: '', unit_price: '' };
const emptyRemittance = { amount: '', transfer_date: '', note: '' };
const emptyVehicle = { vin: '', model_name: '', color: '', model_year: '' };
const emptyPasteColumns = { vin: '', model_name: '', color: '', model_year: '' };


function money(n) {
    return new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2,
    }).format(Number(n || 0));
}

function splitPasteLines(text) {
    return String(text || '')
        .replace(/\r/g, '')
        .split('\n')
        .map((s) => s.trim())
        .filter((s) => s !== '');
}

function ExcelRowForm({ fields, form, setForm, inputRefs, onSubmitId, dir = 'rtl' }) {
    const focusField = (index) => {
        const field = fields[index];
        if (!field) return;
        inputRefs.current[field.key]?.focus();
        inputRefs.current[field.key]?.select?.();
    };

    return (
        <div className="overflow-x-auto rounded border border-gray-300">
            <table className="min-w-full text-sm" dir={dir}>
                <thead className="bg-gray-100 text-[11px] text-gray-600">
                    <tr>
                        {fields.map((f) => (
                            <th key={f.key} className="whitespace-nowrap px-3 py-2 text-start font-semibold">
                                {f.label}{f.required ? ' *' : ''}
                            </th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {fields.map((field, index) => (
                            <td key={field.key} className="border-t border-gray-200 p-1.5">
                                <input
                                    ref={(el) => { inputRefs.current[field.key] = el; }}
                                    type={field.type || 'text'}
                                    step={field.step}
                                    min={field.type === 'number' ? '0' : undefined}
                                    required={field.required}
                                    placeholder={field.placeholder || ''}
                                    value={form[field.key]}
                                    onChange={(e) => setForm((f) => ({ ...f, [field.key]: e.target.value }))}
                                    onKeyDown={(e) => {
                                        if (e.key === 'Tab') {
                                            e.preventDefault();
                                            const next = e.shiftKey ? index - 1 : index + 1;
                                            if (next >= 0 && next < fields.length) focusField(next);
                                            else if (!e.shiftKey) document.getElementById(onSubmitId)?.focus();
                                        }
                                        if (e.key === 'Enter') {
                                            e.preventDefault();
                                            if (index < fields.length - 1) focusField(index + 1);
                                            else document.getElementById(onSubmitId)?.click();
                                        }
                                    }}
                                    onPaste={(e) => {
                                        const text = e.clipboardData?.getData('text') || '';
                                        if (!text.includes('\t') && !text.includes('\n')) return;
                                        e.preventDefault();
                                        const parts = text.replace(/\r/g, '').split(/\t|\n/).map((p) => p.trim());
                                        setForm((current) => {
                                            const next = { ...current };
                                            parts.forEach((part, offset) => {
                                                const f = fields[index + offset];
                                                if (f) next[f.key] = part;
                                            });
                                            return next;
                                        });
                                    }}
                                    className="h-10 w-full min-w-[130px] rounded border border-gray-300 bg-white px-2 text-sm outline-none focus:border-gray-700"
                                />
                            </td>
                        ))}
                    </tr>
                </tbody>
            </table>
        </div>
    );
}

export default function Dashboard({
    companyName,
    batches,
    remittances,
    stats,
    loading,
    onRefresh,
    onLock,
    baseUrl,
    api,
    initialFocus = null,
}) {
    const { t, dir } = useI18n();
    const [highlightVehicleId, setHighlightVehicleId] = useState(null);
    const BATCH_FIELDS = [
        { key: 'car_type', label: t('carType'), required: true },
        { key: 'entry_date', label: t('date'), placeholder: '20/8/2026' },
        { key: 'cars_count', label: t('carsCount'), type: 'number', required: true },
        { key: 'unit_price', label: t('unitPrice'), type: 'number', step: '0.01', required: true },
    ];
    const REM_FIELDS = [
        { key: 'amount', label: t('remAmount'), type: 'number', step: '0.01', required: true },
        { key: 'transfer_date', label: t('remDate'), placeholder: '27/8/2026' },
        { key: 'note', label: t('remNote') },
    ];
    const VEHICLE_PASTE_COLUMNS = [
        { key: 'vin', label: 'VIN', required: true, dir: 'ltr', placeholder: 'LFMAAA0C6T0730496\nLFMAAA0C0T0730509' },
        { key: 'model_name', label: t('model'), placeholder: 'Kawa\nKawa' },
        { key: 'color', label: t('color'), placeholder: t('colorPlaceholder') + '\n' + t('colorPlaceholder') },
        { key: 'model_year', label: t('modelYear'), placeholder: '2024\n2024' },
    ];
    const [tab, setTab] = useState('batches');
    const [batchOpen, setBatchOpen] = useState(false);
    const [remOpen, setRemOpen] = useState(false);
    const [vehiclesOpen, setVehiclesOpen] = useState(false);
    const [vinsViewOpen, setVinsViewOpen] = useState(false);
    const [vinsViewBatch, setVinsViewBatch] = useState(null);
    const [vinsViewList, setVinsViewList] = useState([]);
    const [vinsViewLoading, setVinsViewLoading] = useState(false);
    const [activeBatch, setActiveBatch] = useState(null);
    const [vehicles, setVehicles] = useState([]);
    const [batchForm, setBatchForm] = useState(emptyBatch);
    const [remForm, setRemForm] = useState(emptyRemittance);
    const [vehicleForm, setVehicleForm] = useState(emptyVehicle);
    const [pasteColumns, setPasteColumns] = useState(emptyPasteColumns);
    const [editingBatchId, setEditingBatchId] = useState(null);
    const [editingRemId, setEditingRemId] = useState(null);
    const [editingVehicleId, setEditingVehicleId] = useState(null);
    const [saving, setSaving] = useState(false);
    const [search, setSearch] = useState('');
    const batchRefs = useRef({});
    const remRefs = useRef({});
    const vinExcelRef = useRef(null);

    const filteredBatches = useMemo(() => {
        const q = search.trim().toLowerCase();
        if (!q || tab !== 'batches') return batches;
        return batches.filter((b) => [b.car_type, b.entry_date].filter(Boolean).some((v) => String(v).toLowerCase().includes(q)));
    }, [batches, search, tab]);

    const filteredRemittances = useMemo(() => {
        const q = search.trim().toLowerCase();
        if (!q || tab !== 'remittances') return remittances;
        return remittances.filter((r) => [r.note, r.transfer_date].filter(Boolean).some((v) => String(v).toLowerCase().includes(q)));
    }, [remittances, search, tab]);

    useEffect(() => {
        if (batchOpen) setTimeout(() => batchRefs.current.car_type?.focus(), 40);
    }, [batchOpen]);

    useEffect(() => {
        if (remOpen) setTimeout(() => remRefs.current.amount?.focus(), 40);
    }, [remOpen]);

    const openVinsView = async (batch) => {
        setVinsViewBatch(batch);
        setVinsViewOpen(true);
        setVinsViewLoading(true);
        try {
            const data = await api.loadVehicles(batch.id);
            setVinsViewList(data.vehicles || []);
        } finally {
            setVinsViewLoading(false);
        }
    };

    const openVehicles = async (batch, focusVehicleId = null) => {
        setActiveBatch(batch);
        setVehicleForm(emptyVehicle);
        setPasteColumns(emptyPasteColumns);
        setEditingVehicleId(null);
        setHighlightVehicleId(focusVehicleId);
        setVehiclesOpen(true);
        setTab('batches');
        const data = await api.loadVehicles(batch.id);
        setVehicles(data.vehicles || []);
        setActiveBatch(data.batch || batch);
        if (focusVehicleId) {
            setTimeout(() => {
                document.getElementById(`sa-vehicle-${focusVehicleId}`)?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 120);
        }
    };

    const focusFromSearch = async (focus) => {
        if (!focus?.batchId) return;
        const batch = batches.find((b) => Number(b.id) === Number(focus.batchId));
        if (!batch) return;
        await openVehicles(batch, focus.vehicleId || null);
    };

    useEffect(() => {
        if (!initialFocus?.batchId) return;
        focusFromSearch(initialFocus);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [batches]);

    useEffect(() => {
        const onFocus = (e) => focusFromSearch(e.detail);
        window.addEventListener('sa-focus-vehicle', onFocus);
        return () => window.removeEventListener('sa-focus-vehicle', onFocus);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [batches]);

    useEffect(() => {
        const params = new URLSearchParams(window.location.search);
        const batchId = params.get('batch');
        const vehicleId = params.get('vehicle');
        if (!batchId || !batches.length) return;
        focusFromSearch({
            batchId: Number(batchId),
            vehicleId: vehicleId ? Number(vehicleId) : null,
        });
        params.delete('batch');
        params.delete('vin');
        params.delete('vehicle');
        const next = `${window.location.pathname}${params.toString() ? `?${params}` : ''}`;
        window.history.replaceState({}, '', next);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [batches]);

    const openEditBatch = (batch) => {
        setEditingBatchId(batch.id);
        setBatchForm({
            car_type: batch.car_type || '',
            entry_date: batch.entry_date || '',
            cars_count: String(batch.cars_count ?? ''),
            unit_price: String(batch.unit_price ?? ''),
        });
        setBatchOpen(true);
    };

    const openEditRemittance = (rem) => {
        setEditingRemId(rem.id);
        setRemForm({
            amount: String(rem.amount ?? ''),
            transfer_date: rem.transfer_date || '',
            note: rem.note || '',
        });
        setRemOpen(true);
    };

    const startEditVehicle = (v) => {
        setEditingVehicleId(v.id);
        setVehicleForm({
            vin: v.vin || '',
            model_name: v.model_name || '',
            color: v.color || '',
            model_year: v.model_year != null ? String(v.model_year) : '',
        });
    };

    const submitBatch = async (e) => {
        e.preventDefault();
        setSaving(true);
        try {
            const payload = {
                ...batchForm,
                cars_count: Number(batchForm.cars_count || 0),
                unit_price: Number(batchForm.unit_price || 0),
            };
            if (editingBatchId) {
                const ok = await api.updateBatch(editingBatchId, payload);
                if (!ok) return;
            } else {
                await api.addBatch(payload);
            }
            setBatchForm(emptyBatch);
            setEditingBatchId(null);
            setBatchOpen(false);
        } finally {
            setSaving(false);
        }
    };

    const submitRemittance = async (e) => {
        e.preventDefault();
        setSaving(true);
        try {
            const payload = {
                amount: Number(remForm.amount || 0),
                transfer_date: remForm.transfer_date || null,
                note: remForm.note || null,
            };
            if (editingRemId) {
                const ok = await api.updateRemittance(editingRemId, payload);
                if (!ok) return;
            } else {
                await api.addRemittance(payload);
            }
            setRemForm(emptyRemittance);
            setEditingRemId(null);
            setRemOpen(false);
        } finally {
            setSaving(false);
        }
    };

    const remainingSlots = activeBatch
        ? Math.max(0, Number(activeBatch.cars_count || 0) - vehicles.length)
        : 0;
    const isFull = activeBatch ? remainingSlots <= 0 : false;

    const submitVehicle = async (e) => {
        e.preventDefault();
        if (!activeBatch) return;
        if (!editingVehicleId && isFull) return;
        setSaving(true);
        try {
            const payload = {
                vin: vehicleForm.vin.trim(),
                model_name: vehicleForm.model_name || activeBatch.car_type || null,
                color: vehicleForm.color || null,
                model_year: vehicleForm.model_year ? Number(vehicleForm.model_year) : null,
            };
            const list = editingVehicleId
                ? await api.updateVehicle(activeBatch.id, editingVehicleId, payload)
                : await api.addVehicle(activeBatch.id, payload);
            if (!list) return;
            setVehicles(list);
            setVehicleForm(emptyVehicle);
            setEditingVehicleId(null);
            const refreshed = await api.loadVehicles(activeBatch.id);
            setActiveBatch(refreshed.batch || activeBatch);
        } finally {
            setSaving(false);
        }
    };

    const onVinExcel = async (e) => {
        const file = e.target.files?.[0];
        e.target.value = '';
        if (!file || !activeBatch || isFull) return;
        setSaving(true);
        try {
            const list = await api.importVehicles(activeBatch.id, file);
            setVehicles(list || []);
            const refreshed = await api.loadVehicles(activeBatch.id);
            setActiveBatch(refreshed.batch || activeBatch);
        } finally {
            setSaving(false);
        }
    };

    const pasteRows = useMemo(() => {
        const vins = splitPasteLines(pasteColumns.vin)
            .map((v) => v.toUpperCase().replace(/\s+/g, ''))
            .filter((v) => v && v !== 'VIN');
        const models = splitPasteLines(pasteColumns.model_name);
        const colors = splitPasteLines(pasteColumns.color);
        const years = splitPasteLines(pasteColumns.model_year);
        const seen = new Set();
        const rows = [];
        vins.forEach((vin, i) => {
            if (seen.has(vin)) return;
            seen.add(vin);
            const yearRaw = years[i];
            const yearNum = yearRaw ? Number(yearRaw) : null;
            rows.push({
                vin,
                model_name: models[i] || null,
                color: colors[i] || null,
                model_year: Number.isFinite(yearNum) ? yearNum : null,
            });
        });
        return rows;
    }, [pasteColumns]);

    const pasteAllowedCount = Math.min(pasteRows.length, remainingSlots);

    const submitVinPaste = async () => {
        if (!activeBatch || pasteAllowedCount === 0 || isFull) return;
        setSaving(true);
        try {
            const list = await api.importVehiclesText(activeBatch.id, pasteRows.slice(0, pasteAllowedCount));
            if (!list) return;
            setVehicles(list);
            setPasteColumns(emptyPasteColumns);
            const refreshed = await api.loadVehicles(activeBatch.id);
            setActiveBatch(refreshed.batch || activeBatch);
        } finally {
            setSaving(false);
        }
    };

    return (
        <div className="mx-auto max-w-7xl px-4 py-6">
            <PageHeader
                title={companyName}
                actions={
                    <>
                        <ToolbarButton onClick={onRefresh} disabled={loading}>{t('refresh')}</ToolbarButton>
                        <ToolbarButton onClick={api.exportExcel}>{t('exportExcel')}</ToolbarButton>
                        <ToolbarButton danger onClick={onLock}>{t('lock')}</ToolbarButton>
                    </>
                }
            />

            <div className="mb-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <StatCard label={t('statCars')} value={Number(stats.cars_total || 0).toLocaleString('en-US')} />
                <StatCard label={t('statCarsTotal')} value={money(stats.amount_total)} />
                <StatCard label={t('statTransfers')} value={money(stats.transfer_total)} tone="green" />
                <StatCard label={t('statRemaining')} value={money(stats.remaining)} tone="orange" />
            </div>

            <div className="mb-4 flex flex-wrap gap-2 border-b border-gray-300">
                {[
                    { id: 'batches', label: t('carsTab'), count: batches.length },
                    { id: 'remittances', label: t('remittancesTab'), count: remittances.length },
                ].map((item) => (
                    <button
                        key={item.id}
                        type="button"
                        onClick={() => { setTab(item.id); setSearch(''); }}
                        className={`-mb-px border px-4 py-2 text-sm font-medium ${
                            tab === item.id ? 'brand-bg border-transparent text-white' : 'border-gray-300 bg-white text-gray-700'
                        }`}
                    >
                        {item.label}
                        <span className={`ms-2 rounded px-1.5 py-0.5 text-[10px] ${tab === item.id ? 'bg-white/20' : 'bg-gray-100'}`}>
                            {item.count}
                        </span>
                    </button>
                ))}
            </div>

            {tab === 'batches' && (
                <Card>
                    <CardHeader
                        title={t('batchLines')}
                        actions={
                            <div className="flex flex-wrap gap-2">
                                <TextInput value={search} onChange={(e) => setSearch(e.target.value)} placeholder={t('search')} className="w-44" />
                                <ToolbarButton primary onClick={() => { setEditingBatchId(null); setBatchForm(emptyBatch); setBatchOpen(true); }}>{t('addBatch')}</ToolbarButton>
                            </div>
                        }
                    />
                    <div className="overflow-x-auto p-3">
                        <table className="min-w-full border-collapse text-sm" dir={dir}>
                            <thead className="bg-gray-100 text-[11px] text-gray-600">
                                <tr>
                                    <th className="border border-gray-300 px-3 py-2 text-start">#</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('carType')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('date')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('carsCount')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('unitPrice')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('totalAmount')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('vinsEntered')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {filteredBatches.map((b, idx) => (
                                    <tr key={b.id}>
                                        <td className="border border-gray-300 px-3 py-2">{idx + 1}</td>
                                        <td className="border border-gray-300 px-3 py-2 font-medium">{b.car_type}</td>
                                        <td className="whitespace-nowrap border border-gray-300 px-3 py-2">{b.entry_date || '—'}</td>
                                        <td className="border border-gray-300 px-3 py-2">
                                            <button
                                                type="button"
                                                title={t('clickToViewVins')}
                                                onClick={() => openVinsView(b)}
                                                className="font-semibold text-blue-600 underline decoration-dotted underline-offset-2 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                            >
                                                {b.cars_count}
                                            </button>
                                        </td>
                                        <td className="whitespace-nowrap border border-gray-300 px-3 py-2" dir="ltr">{money(b.unit_price)}</td>
                                        <td className="whitespace-nowrap border border-gray-300 px-3 py-2 font-semibold" dir="ltr">{money(b.total_amount)}</td>
                                        <td className="border border-gray-300 px-3 py-2">
                                            {b.vehicles_entered || 0} / {b.cars_count}
                                        </td>
                                        <td className="border border-gray-300 px-2 py-1.5">
                                            <div className="flex flex-nowrap gap-1 whitespace-nowrap">
                                                <ToolbarButton small primary onClick={() => openVehicles(b)}>{t('enterVehicles')}</ToolbarButton>
                                                <ToolbarButton small onClick={() => openEditBatch(b)}>{t('edit')}</ToolbarButton>
                                                <ToolbarButton small danger onClick={() => api.deleteBatch(b.id)}>{t('delete')}</ToolbarButton>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                                {filteredBatches.length === 0 && (
                                    <tr>
                                        <td colSpan="8" className="border border-gray-300 px-3 py-8 text-center text-gray-500">{t('noBatches')}</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </Card>
            )}

            {tab === 'remittances' && (
                <Card>
                    <CardHeader
                        title={t('remittances')}
                        subtitle={t('remittancesSubtitle', { amount: money(stats.amount_total) })}
                        actions={
                            <div className="flex flex-wrap gap-2">
                                <TextInput value={search} onChange={(e) => setSearch(e.target.value)} placeholder={t('search')} className="w-44" />
                                <ToolbarButton primary onClick={() => { setEditingRemId(null); setRemForm(emptyRemittance); setRemOpen(true); }}>{t('addRemittance')}</ToolbarButton>
                            </div>
                        }
                    />
                    <div className="overflow-x-auto p-3">
                        <table className="min-w-full border-collapse text-sm" dir={dir}>
                            <thead className="bg-gray-100 text-[11px] text-gray-600">
                                <tr>
                                    <th className="border border-gray-300 px-3 py-2 text-start">#</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('remAmount')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('remDate')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('remNote')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start">{t('actions')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {filteredRemittances.map((r, idx) => (
                                    <tr key={r.id}>
                                        <td className="border border-gray-300 px-3 py-2">{idx + 1}</td>
                                        <td className="whitespace-nowrap border border-gray-300 px-3 py-2 font-semibold text-green-700" dir="ltr">{money(r.amount)}</td>
                                        <td className="whitespace-nowrap border border-gray-300 px-3 py-2">{r.transfer_date || '—'}</td>
                                        <td className="border border-gray-300 px-3 py-2">{r.note || '—'}</td>
                                        <td className="border border-gray-300 px-2 py-1.5">
                                            <div className="flex flex-nowrap gap-1 whitespace-nowrap">
                                                <ToolbarButton small onClick={() => openEditRemittance(r)}>{t('edit')}</ToolbarButton>
                                                <a href={`${baseUrl}/vouchers/${r.id}/receipt`} target="_blank" rel="noreferrer">
                                                    <ToolbarButton small>{t('receipt')}</ToolbarButton>
                                                </a>
                                                <a href={`${baseUrl}/vouchers/${r.id}/payment`} target="_blank" rel="noreferrer">
                                                    <ToolbarButton small>{t('payment')}</ToolbarButton>
                                                </a>
                                                <ToolbarButton small danger onClick={() => api.deleteRemittance(r.id)}>{t('delete')}</ToolbarButton>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                                {filteredRemittances.length === 0 && (
                                    <tr>
                                        <td colSpan="5" className="border border-gray-300 px-3 py-8 text-center text-gray-500">{t('noRemittances')}</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </Card>
            )}

            <Modal
                open={batchOpen}
                onClose={() => {
                    if (saving) return;
                    setBatchOpen(false);
                    setEditingBatchId(null);
                }}
                wide
                title={editingBatchId ? t('editBatch') : t('addBatchTitle')}
                footer={
                    <>
                        <ToolbarButton onClick={() => { setBatchOpen(false); setEditingBatchId(null); }} disabled={saving}>{t('cancel')}</ToolbarButton>
                        <ToolbarButton primary type="submit" id="sa-batch-submit" form="sa-batch-form" disabled={saving}>
                            {saving ? t('saving') : (editingBatchId ? t('saveEdit') : t('saveBatch'))}
                        </ToolbarButton>
                    </>
                }
            >
                <form id="sa-batch-form" onSubmit={submitBatch}>
                    <ExcelRowForm fields={BATCH_FIELDS} form={batchForm} setForm={setBatchForm} inputRefs={batchRefs} onSubmitId="sa-batch-submit" dir={dir} />
                    <p className="mt-3 text-sm text-gray-600">
                        {t('expectedTotal')} <strong>{money(Number(batchForm.cars_count || 0) * Number(batchForm.unit_price || 0))}</strong>
                    </p>
                </form>
            </Modal>

            <Modal
                open={remOpen}
                onClose={() => {
                    if (saving) return;
                    setRemOpen(false);
                    setEditingRemId(null);
                }}
                wide
                title={editingRemId ? t('editRemittance') : t('addRemittanceTitle')}
                footer={
                    <>
                        <ToolbarButton onClick={() => { setRemOpen(false); setEditingRemId(null); }} disabled={saving}>{t('cancel')}</ToolbarButton>
                        <ToolbarButton primary type="submit" id="sa-rem-submit" form="sa-rem-form" disabled={saving}>
                            {saving ? t('saving') : (editingRemId ? t('saveEdit') : t('saveRemittance'))}
                        </ToolbarButton>
                    </>
                }
            >
                <form id="sa-rem-form" onSubmit={submitRemittance}>
                    <ExcelRowForm fields={REM_FIELDS} form={remForm} setForm={setRemForm} inputRefs={remRefs} onSubmitId="sa-rem-submit" dir={dir} />
                </form>
            </Modal>

            <Modal
                open={vinsViewOpen}
                onClose={() => setVinsViewOpen(false)}
                title={vinsViewBatch ? t('viewVinsOf', { type: vinsViewBatch.car_type }) : t('viewVinsTitle')}
                subtitle={vinsViewBatch ? `${vinsViewList.length} / ${vinsViewBatch.cars_count}` : ''}
                footer={<ToolbarButton onClick={() => setVinsViewOpen(false)}>{t('close')}</ToolbarButton>}
            >
                {vinsViewLoading ? (
                    <p className="py-6 text-center text-sm text-gray-500 dark:text-gray-400">{t('loadingSystem')}</p>
                ) : vinsViewList.length === 0 ? (
                    <p className="py-6 text-center text-sm text-gray-500 dark:text-gray-400">{t('viewVinsEmpty')}</p>
                ) : (
                    <div className="max-h-[60vh] overflow-auto rounded border border-gray-300 dark:border-gray-700">
                        <table className="min-w-full text-sm" dir={dir}>
                            <thead className="bg-gray-100 text-[11px] text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                <tr>
                                    <th className="border border-gray-300 px-3 py-2 text-start dark:border-gray-700">#</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start dark:border-gray-700">VIN</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start dark:border-gray-700">{t('model')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start dark:border-gray-700">{t('color')}</th>
                                    <th className="border border-gray-300 px-3 py-2 text-start dark:border-gray-700">{t('modelYear')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {vinsViewList.map((v, idx) => (
                                    <tr key={v.id}>
                                        <td className="border border-gray-300 px-3 py-2 dark:border-gray-700">{v.seq || idx + 1}</td>
                                        <td className="border border-gray-300 px-3 py-2 font-mono dark:border-gray-700" dir="ltr">{v.vin || '—'}</td>
                                        <td className="border border-gray-300 px-3 py-2 dark:border-gray-700">{v.model_name || vinsViewBatch?.car_type || '—'}</td>
                                        <td className="border border-gray-300 px-3 py-2 dark:border-gray-700">{v.color || '—'}</td>
                                        <td className="border border-gray-300 px-3 py-2 dark:border-gray-700">{v.model_year || '—'}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                )}
            </Modal>

            <Modal
                open={vehiclesOpen}
                onClose={() => !saving && setVehiclesOpen(false)}
                wide
                title={activeBatch ? t('vehiclesOfBatch', { type: activeBatch.car_type }) : t('vehiclesTitle')}
                subtitle={
                    activeBatch
                        ? t('vehiclesMeta', { need: activeBatch.cars_count, entered: vehicles.length, left: remainingSlots })
                        : ''
                }
                footer={<ToolbarButton onClick={() => setVehiclesOpen(false)}>{t('close')}</ToolbarButton>}
            >
                {activeBatch && (
                    <div className="space-y-4">
                        {isFull && (
                            <div className="rounded border border-amber-300 bg-amber-50 px-3 py-2 text-sm text-amber-800">
                                {t('vehiclesFull', { count: activeBatch.cars_count })}
                            </div>
                        )}

                        <div className="space-y-3 rounded border border-gray-300 bg-gray-50 p-3">
                            <div className="text-sm font-medium text-gray-700">
                                {t('pasteTitle')}
                            </div>
                            <div className="grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                                {VEHICLE_PASTE_COLUMNS.map((col) => (
                                    <label key={col.key} className="block text-sm">
                                        <span className="mb-1 block font-medium text-gray-700">
                                            {col.label}{col.required ? ' *' : ''}
                                        </span>
                                        <textarea
                                            value={pasteColumns[col.key]}
                                            onChange={(e) => setPasteColumns((f) => ({ ...f, [col.key]: e.target.value }))}
                                            rows={8}
                                            dir={col.dir || dir}
                                            disabled={isFull}
                                            className="w-full rounded border border-gray-300 px-2 py-2 font-mono text-sm leading-6 disabled:bg-gray-100"
                                            placeholder={col.placeholder}
                                        />
                                    </label>
                                ))}
                            </div>
                            <div className="flex flex-wrap items-center gap-2">
                                <span className="text-xs text-gray-600">
                                    {pasteRows.length > 0
                                        ? t('pasteReady', { ready: pasteRows.length, allowed: pasteAllowedCount })
                                        : t('pasteHint')}
                                </span>
                                <ToolbarButton
                                    primary
                                    disabled={saving || pasteAllowedCount === 0 || isFull}
                                    onClick={submitVinPaste}
                                >
                                    {saving ? t('saving') : t('addNCars', { n: pasteAllowedCount || '' })}
                                </ToolbarButton>
                                <ToolbarButton
                                    disabled={saving || Object.values(pasteColumns).every((v) => !v)}
                                    onClick={() => setPasteColumns(emptyPasteColumns)}
                                >
                                    {t('clearPaste')}
                                </ToolbarButton>
                                <ToolbarButton disabled={saving || isFull} onClick={() => vinExcelRef.current?.click()}>
                                    {t('importExcelFile')}
                                </ToolbarButton>
                                <input ref={vinExcelRef} type="file" accept=".xlsx,.xls,.csv" className="hidden" onChange={onVinExcel} />
                            </div>
                        </div>

                        <div className="flex flex-wrap items-end gap-2 rounded border border-gray-300 bg-white p-3">
                            {editingVehicleId && (
                                <div className="w-full rounded border border-blue-200 bg-blue-50 px-3 py-2 text-sm text-blue-800">
                                    {t('editingVehicle', { id: editingVehicleId })}
                                    <button
                                        type="button"
                                        className="ms-3 underline"
                                        onClick={() => { setEditingVehicleId(null); setVehicleForm(emptyVehicle); }}
                                    >
                                        {t('cancelEdit')}
                                    </button>
                                </div>
                            )}
                            <label className="text-sm">
                                <span className="mb-1 block font-medium text-gray-700">VIN</span>
                                <input
                                    value={vehicleForm.vin}
                                    onChange={(e) => setVehicleForm((f) => ({ ...f, vin: e.target.value }))}
                                    disabled={!editingVehicleId && isFull}
                                    className="h-9 w-56 rounded border border-gray-300 px-2 text-sm disabled:bg-gray-100"
                                    placeholder="LFMAAA0C6T0730496"
                                    dir="ltr"
                                />
                            </label>
                            <label className="text-sm">
                                <span className="mb-1 block font-medium text-gray-700">{t('model')}</span>
                                <input
                                    value={vehicleForm.model_name}
                                    onChange={(e) => setVehicleForm((f) => ({ ...f, model_name: e.target.value }))}
                                    disabled={!editingVehicleId && isFull}
                                    className="h-9 w-40 rounded border border-gray-300 px-2 text-sm disabled:bg-gray-100"
                                    placeholder={activeBatch.car_type || ''}
                                />
                            </label>
                            <label className="text-sm">
                                <span className="mb-1 block font-medium text-gray-700">{t('color')}</span>
                                <input
                                    value={vehicleForm.color}
                                    onChange={(e) => setVehicleForm((f) => ({ ...f, color: e.target.value }))}
                                    disabled={!editingVehicleId && isFull}
                                    className="h-9 w-32 rounded border border-gray-300 px-2 text-sm disabled:bg-gray-100"
                                    placeholder={t('colorPlaceholder')}
                                />
                            </label>
                            <label className="text-sm">
                                <span className="mb-1 block font-medium text-gray-700">{t('modelYear')}</span>
                                <input
                                    type="number"
                                    min="1900"
                                    max="2100"
                                    value={vehicleForm.model_year}
                                    onChange={(e) => setVehicleForm((f) => ({ ...f, model_year: e.target.value }))}
                                    disabled={!editingVehicleId && isFull}
                                    className="h-9 w-28 rounded border border-gray-300 px-2 text-sm disabled:bg-gray-100"
                                    placeholder="2024"
                                />
                            </label>
                            <ToolbarButton
                                primary
                                disabled={saving || !vehicleForm.vin.trim() || (!editingVehicleId && isFull)}
                                onClick={submitVehicle}
                            >
                                {saving ? t('saving') : (editingVehicleId ? t('saveEdit') : t('addVehicle'))}
                            </ToolbarButton>
                        </div>

                        <div className="overflow-x-auto rounded border border-gray-300">
                            <table className="min-w-full text-sm" dir={dir}>
                                <thead className="bg-gray-100 text-[11px] text-gray-600">
                                    <tr>
                                        <th className="border border-gray-300 px-3 py-2 text-start">#</th>
                                        <th className="border border-gray-300 px-3 py-2 text-start">{t('model')}</th>
                                        <th className="border border-gray-300 px-3 py-2 text-start">{t('color')}</th>
                                        <th className="border border-gray-300 px-3 py-2 text-start">{t('modelYear')}</th>
                                        <th className="border border-gray-300 px-3 py-2 text-start">VIN</th>
                                        <th className="border border-gray-300 px-3 py-2 text-start">{t('actions')}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {vehicles.map((v, idx) => (
                                        <tr
                                            key={v.id}
                                            id={`sa-vehicle-${v.id}`}
                                            className={Number(highlightVehicleId) === Number(v.id) ? 'sa-highlight' : ''}
                                        >
                                            <td className="border border-gray-300 px-3 py-2 dark:border-gray-700">{v.seq || idx + 1}</td>
                                            <td className="border border-gray-300 px-3 py-2">{v.model_name || activeBatch.car_type || '—'}</td>
                                            <td className="border border-gray-300 px-3 py-2">{v.color || '—'}</td>
                                            <td className="border border-gray-300 px-3 py-2">{v.model_year || '—'}</td>
                                            <td className="border border-gray-300 px-3 py-2 font-mono" dir="ltr">{v.vin}</td>
                                            <td className="border border-gray-300 px-2 py-1.5">
                                                <div className="flex flex-nowrap gap-1 whitespace-nowrap">
                                                    <ToolbarButton small onClick={() => startEditVehicle(v)}>{t('edit')}</ToolbarButton>
                                                    <ToolbarButton
                                                        small
                                                        danger
                                                        onClick={async () => {
                                                            const list = await api.deleteVehicle(activeBatch.id, v.id);
                                                            if (list) {
                                                                if (editingVehicleId === v.id) {
                                                                    setEditingVehicleId(null);
                                                                    setVehicleForm(emptyVehicle);
                                                                }
                                                                setVehicles(list);
                                                                const refreshed = await api.loadVehicles(activeBatch.id);
                                                                setActiveBatch(refreshed.batch || activeBatch);
                                                            }
                                                        }}
                                                    >
                                                        {t('delete')}
                                                    </ToolbarButton>
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                    {vehicles.length === 0 && (
                                        <tr>
                                            <td colSpan="6" className="border border-gray-300 px-3 py-6 text-center text-gray-500">
                                                {t('noVehicles')}
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                )}
            </Modal>
        </div>
    );
}