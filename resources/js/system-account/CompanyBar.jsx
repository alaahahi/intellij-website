import React, { useState } from 'react';
import { ToolbarButton } from './ui';
import { LanguageSwitcher, useI18n } from './i18n/I18nProvider';

export default function CompanyBar({
    companies,
    currentSlug,
    onCreate,
    onDelete,
    creating = false,
    deleting = false,
}) {
    const { t } = useI18n();
    const [open, setOpen] = useState(false);
    const [deleteTarget, setDeleteTarget] = useState(null);
    const [name, setName] = useState('');
    const [slug, setSlug] = useState('');
    const [pin, setPin] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');

    const submit = async (e) => {
        e.preventDefault();
        setError('');
        try {
            await onCreate({ name: name.trim(), slug: slug.trim() || null, pin });
            setName('');
            setSlug('');
            setPin('');
            setOpen(false);
        } catch (err) {
            setError(err?.response?.data?.message || err?.message || t('createCompanyFailed'));
        }
    };

    const submitDelete = async (e) => {
        e.preventDefault();
        if (!deleteTarget) return;
        setError('');
        try {
            await onDelete({ slug: deleteTarget.slug, password });
            setPassword('');
            setDeleteTarget(null);
        } catch (err) {
            setError(err?.response?.data?.message || err?.message || t('deleteCompanyFailed'));
        }
    };

    return (
        <div className="border-b border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900">
            <div className="mx-auto flex max-w-7xl flex-wrap items-center gap-2 px-4 py-2">
                <span className="me-1 text-xs font-semibold text-gray-500 dark:text-gray-400">{t('companies')}</span>
                {companies.map((c) => {
                    const active = c.slug === currentSlug;
                    return (
                        <div key={c.slug} className="inline-flex items-stretch overflow-hidden rounded border border-gray-300">
                            <a
                                href={c.url}
                                className={`px-3 py-1.5 text-sm font-medium transition ${
                                    active
                                        ? 'brand-bg'
                                        : 'bg-white text-gray-700 hover:bg-gray-50 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800'
                                }`}
                            >
                                {c.name}
                            </a>
                            <button
                                type="button"
                                title={t('deleteCompany')}
                                disabled={deleting}
                                onClick={() => {
                                    setOpen(false);
                                    setError('');
                                    setPassword('');
                                    setDeleteTarget(c);
                                }}
                                className={`border-s px-2 text-xs font-medium ${
                                    active
                                        ? 'brand-bg border-black/10 hover:bg-red-700 hover:text-white'
                                        : 'border-gray-300 bg-white text-red-700 hover:bg-red-50 dark:border-gray-600 dark:bg-gray-900 dark:hover:bg-red-950'
                                }`}
                            >
                                ×
                            </button>
                        </div>
                    );
                })}
                <ToolbarButton small primary onClick={() => { setDeleteTarget(null); setOpen((v) => !v); }}>
                    {t('addCompany')}
                </ToolbarButton>
                <div className="ms-auto">
                    <LanguageSwitcher />
                </div>
            </div>

            {open && (
                <div className="mx-auto max-w-7xl border-t border-gray-200 px-4 py-3">
                    <form onSubmit={submit} className="flex flex-wrap items-end gap-2">
                        <label className="text-sm">
                            <span className="mb-1 block font-medium text-gray-700">{t('companyName')} *</span>
                            <input
                                required
                                value={name}
                                onChange={(e) => setName(e.target.value)}
                                className="h-9 w-56 rounded border border-gray-300 px-2 text-sm"
                                placeholder={t('companyPlaceholder')}
                            />
                        </label>
                        <label className="text-sm">
                            <span className="mb-1 block font-medium text-gray-700">{t('englishSlug')}</span>
                            <input
                                value={slug}
                                onChange={(e) => setSlug(e.target.value.toLowerCase().replace(/[^a-z0-9-]/g, ''))}
                                className="h-9 w-44 rounded border border-gray-300 px-2 text-sm"
                                placeholder="al-khaleej"
                                dir="ltr"
                            />
                        </label>
                        <label className="text-sm">
                            <span className="mb-1 block font-medium text-gray-700">{t('pin')} *</span>
                            <input
                                required
                                type="password"
                                inputMode="numeric"
                                value={pin}
                                onChange={(e) => setPin(e.target.value)}
                                className="h-9 w-32 rounded border border-gray-300 px-2 text-sm"
                                placeholder="123456"
                                dir="ltr"
                            />
                        </label>
                        <ToolbarButton primary type="submit" disabled={creating || !name.trim() || !pin}>
                            {creating ? t('creating') : t('create')}
                        </ToolbarButton>
                        <ToolbarButton type="button" onClick={() => setOpen(false)}>{t('cancel')}</ToolbarButton>
                        {error && <span className="w-full text-sm text-red-600">{error}</span>}
                    </form>
                </div>
            )}

            {deleteTarget && (
                <div className="mx-auto max-w-7xl border-t border-red-200 bg-red-50 px-4 py-3">
                    <form onSubmit={submitDelete} className="flex flex-wrap items-end gap-2">
                        <p className="w-full text-sm text-red-800">
                            {t('deleteSoftHint', { name: deleteTarget.name })}
                        </p>
                        <label className="text-sm">
                            <span className="mb-1 block font-medium text-gray-700">{t('password')} *</span>
                            <input
                                required
                                type="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                className="h-9 w-56 rounded border border-gray-300 px-2 text-sm"
                                placeholder="••••••••"
                                dir="ltr"
                                autoFocus
                            />
                        </label>
                        <ToolbarButton danger type="submit" disabled={deleting || !password}>
                            {deleting ? t('deleting') : t('confirmDelete')}
                        </ToolbarButton>
                        <ToolbarButton type="button" onClick={() => { setDeleteTarget(null); setPassword(''); setError(''); }}>
                            {t('cancel')}
                        </ToolbarButton>
                        {error && <span className="w-full text-sm text-red-600">{error}</span>}
                    </form>
                </div>
            )}
        </div>
    );
}
