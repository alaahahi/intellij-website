import React, { useEffect, useRef, useState } from 'react';
import axios from 'axios';
import { useI18n } from './i18n/I18nProvider';
import { useTheme } from './ThemeProvider';

const FOCUS_KEY = 'sa_focus_vehicle';

export function saveFocusTarget(payload) {
    try {
        sessionStorage.setItem(FOCUS_KEY, JSON.stringify(payload));
    } catch {
        // ignore
    }
}

export function consumeFocusTarget() {
    try {
        const raw = sessionStorage.getItem(FOCUS_KEY);
        if (!raw) return null;
        sessionStorage.removeItem(FOCUS_KEY);
        return JSON.parse(raw);
    } catch {
        return null;
    }
}

export default function TopNav({ currentSlug, companiesUrl }) {
    const { t } = useI18n();
    const { isDark, toggleTheme } = useTheme();
    const [q, setQ] = useState('');
    const [results, setResults] = useState([]);
    const [open, setOpen] = useState(false);
    const [loading, setLoading] = useState(false);
    const boxRef = useRef(null);
    const timerRef = useRef(null);

    useEffect(() => {
        const onDoc = (e) => {
            if (!boxRef.current?.contains(e.target)) setOpen(false);
        };
        document.addEventListener('mousedown', onDoc);
        return () => document.removeEventListener('mousedown', onDoc);
    }, []);

    useEffect(() => {
        if (timerRef.current) clearTimeout(timerRef.current);
        const query = q.trim();
        if (query.length < 3) {
            setResults([]);
            setLoading(false);
            return undefined;
        }
        setLoading(true);
        timerRef.current = setTimeout(async () => {
            try {
                const base = companiesUrl.replace(/\/companies\/?$/, '');
                const { data } = await axios.get(`${base}/search-vin`, { params: { q: query } });
                setResults(data.data || []);
                setOpen(true);
            } catch {
                setResults([]);
            } finally {
                setLoading(false);
            }
        }, 280);
        return () => {
            if (timerRef.current) clearTimeout(timerRef.current);
        };
    }, [q, companiesUrl]);

    const openResult = (item) => {
        const focus = {
            slug: item.company_slug,
            batchId: item.batch_id,
            vehicleId: item.vehicle_id,
            vin: item.vin,
        };
        saveFocusTarget(focus);
        setOpen(false);
        setQ(item.vin || '');

        if (item.company_slug === currentSlug) {
            window.dispatchEvent(new CustomEvent('sa-focus-vehicle', { detail: focus }));
            return;
        }

        const url = new URL(item.company_url, window.location.origin);
        url.searchParams.set('batch', String(item.batch_id));
        url.searchParams.set('vin', item.vin || '');
        url.searchParams.set('vehicle', String(item.vehicle_id || ''));
        window.location.href = url.toString();
    };

    return (
        <div className="border-b border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900">
            <div className="mx-auto flex max-w-7xl flex-wrap items-center gap-3 px-4 py-2.5">
                <div className="text-sm font-semibold text-green-700 dark:text-green-400">
                    {t('vinSearchTitle')}
                </div>
                <div className="relative min-w-[220px] flex-1" ref={boxRef}>
                    <input
                        value={q}
                        onChange={(e) => setQ(e.target.value)}
                        onFocus={() => results.length > 0 && setOpen(true)}
                        placeholder={t('vinSearchPlaceholder')}
                        dir="ltr"
                        className="h-10 w-full rounded border border-gray-300 bg-white px-3 text-sm text-gray-900 outline-none focus:border-gray-700 dark:border-gray-600 dark:bg-gray-950 dark:text-gray-100"
                    />
                    {open && (
                        <div className="absolute z-40 mt-1 max-h-80 w-full overflow-auto rounded border border-gray-300 bg-white shadow-lg dark:border-gray-600 dark:bg-gray-900">
                            {loading && (
                                <div className="px-3 py-2 text-xs text-gray-500 dark:text-gray-400">{t('searching')}</div>
                            )}
                            {!loading && results.length === 0 && q.trim().length >= 3 && (
                                <div className="px-3 py-2 text-xs text-gray-500 dark:text-gray-400">{t('noVinResults')}</div>
                            )}
                            {results.map((item) => (
                                <button
                                    key={`${item.company_slug}-${item.vehicle_id}`}
                                    type="button"
                                    onClick={() => openResult(item)}
                                    className="flex w-full flex-col gap-0.5 border-b border-gray-100 px-3 py-2 text-start hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-800"
                                >
                                    <span className="font-mono text-sm font-semibold text-gray-900 dark:text-gray-100" dir="ltr">
                                        {item.vin}
                                    </span>
                                    <span className="text-xs text-gray-600 dark:text-gray-400">
                                        {item.company_name}
                                        {item.car_type ? ` · ${item.car_type}` : ''}
                                        {item.model_name ? ` · ${item.model_name}` : ''}
                                        {item.color ? ` · ${item.color}` : ''}
                                    </span>
                                </button>
                            ))}
                        </div>
                    )}
                </div>
                <button
                    type="button"
                    onClick={toggleTheme}
                    className="h-10 rounded border border-gray-300 px-3 text-xs font-medium text-gray-800 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-100 dark:hover:bg-gray-800"
                    title={isDark ? t('lightMode') : t('darkMode')}
                >
                    {isDark ? t('lightMode') : t('darkMode')}
                </button>
            </div>
        </div>
    );
}
