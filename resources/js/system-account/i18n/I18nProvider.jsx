import React, { createContext, useCallback, useContext, useEffect, useMemo, useState } from 'react';
import { DEFAULT_LOCALE, LOCALES, localeMeta, translate } from './translations';

const STORAGE_KEY = 'system_account_lang';
const I18nContext = createContext(null);

function readStoredLocale() {
    try {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved && LOCALES.some((l) => l.code === saved)) return saved;
    } catch {
        // ignore
    }
    return DEFAULT_LOCALE;
}

export function I18nProvider({ children }) {
    const [locale, setLocaleState] = useState(readStoredLocale);

    const setLocale = useCallback((code) => {
        if (!LOCALES.some((l) => l.code === code)) return;
        setLocaleState(code);
        try {
            localStorage.setItem(STORAGE_KEY, code);
        } catch {
            // ignore
        }
    }, []);

    const meta = localeMeta(locale);

    useEffect(() => {
        document.documentElement.lang = locale === 'ckb' ? 'ckb' : locale;
        document.documentElement.dir = meta.dir;
        document.body.dir = meta.dir;
    }, [locale, meta.dir]);

    const t = useCallback((key, params) => translate(locale, key, params), [locale]);

    const value = useMemo(
        () => ({ locale, setLocale, t, dir: meta.dir, locales: LOCALES }),
        [locale, setLocale, t, meta.dir],
    );

    return <I18nContext.Provider value={value}>{children}</I18nContext.Provider>;
}

export function useI18n() {
    const ctx = useContext(I18nContext);
    if (!ctx) throw new Error('useI18n must be used inside I18nProvider');
    return ctx;
}

export function LanguageSwitcher({ className = '' }) {
    const { locale, setLocale, locales, t } = useI18n();

    return (
        <label className={`inline-flex items-center gap-1.5 text-xs text-gray-600 ${className}`}>
            <span className="hidden sm:inline">{t('language')}</span>
            <select
                value={locale}
                onChange={(e) => setLocale(e.target.value)}
                className="h-8 rounded border border-gray-300 bg-white px-2 text-xs text-gray-800 outline-none focus:border-gray-700 dark:border-gray-600 dark:bg-gray-950 dark:text-gray-100"
            >
                {locales.map((l) => (
                    <option key={l.code} value={l.code}>{l.label}</option>
                ))}
            </select>
        </label>
    );
}
