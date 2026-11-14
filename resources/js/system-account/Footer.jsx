import React from 'react';
import { useI18n } from './i18n/I18nProvider';

export default function Footer({ license }) {
    const { t } = useI18n();
    const vendor = license?.vendor_name || 'التطبيق الذكي';
    const daysLeft = Number(license?.days_left || 0);
    const active = Boolean(license?.active && daysLeft > 0);

    return (
        <footer className="mt-auto border-t border-gray-200/80 bg-transparent px-4 py-3 dark:border-gray-800">
            <div className="mx-auto flex max-w-7xl flex-wrap items-center justify-center gap-2 text-center text-xs text-gray-500 dark:text-gray-400">
                <a
                    href="https://wa.me/9647511077812"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="font-medium text-gray-600 transition hover:text-emerald-600 dark:text-gray-300 dark:hover:text-emerald-400"
                    title="WhatsApp"
                >
                    {vendor}
                </a>
                <span className="text-gray-300 dark:text-gray-600">·</span>
                {active ? (
                    <span>{t('licenseActiveDays', { days: daysLeft })}</span>
                ) : (
                    <span className="text-amber-700 dark:text-amber-400">{t('licenseExpired')}</span>
                )}
            </div>
        </footer>
    );
}
