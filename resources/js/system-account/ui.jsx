import React from 'react';

export function PageHeader({ title, subtitle, actions }) {
    return (
        <div className="mb-4 flex flex-wrap items-start justify-between gap-3">
            <div>
                <h1 className="text-xl font-semibold tracking-tight text-green-700 dark:text-green-400">{title}</h1>
                {subtitle && <p className="text-sm text-gray-500 dark:text-gray-400">{subtitle}</p>}
            </div>
            {actions && <div className="flex flex-wrap items-center gap-2">{actions}</div>}
        </div>
    );
}

export function ToolbarButton({ children, primary, danger, small, className = '', ...rest }) {
    const size = small ? 'h-7 px-2.5 text-[11px]' : 'h-8 px-3 text-xs';
    const tone = primary
        ? 'brand-bg border-transparent'
        : danger
          ? 'border-gray-300 bg-white text-red-700 dark:border-gray-600 dark:bg-gray-900 dark:text-red-400'
          : 'border-gray-300 bg-white text-gray-800 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100';

    return (
        <button
            type="button"
            className={`inline-flex items-center gap-1.5 rounded border font-medium whitespace-nowrap disabled:opacity-50 ${size} ${tone} ${className}`}
            {...rest}
        >
            {children}
        </button>
    );
}

export function Card({ children, className = '' }) {
    return <div className={`rounded border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900 ${className}`}>{children}</div>;
}

export function CardHeader({ title, subtitle, actions }) {
    return (
        <div className="flex items-start justify-between gap-3 border-b border-gray-300 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-800/60">
            <div>
                <h3 className="font-semibold text-green-700 dark:text-green-400">{title}</h3>
                {subtitle && <p className="text-xs text-gray-500 dark:text-gray-400">{subtitle}</p>}
            </div>
            {actions}
        </div>
    );
}

export function StatCard({ label, value, tone = 'default' }) {
    const tones = {
        default: 'text-gray-900 dark:text-gray-100',
        red: 'text-red-700 dark:text-red-400',
        green: 'text-green-700 dark:text-green-400',
        orange: 'text-orange-700 dark:text-orange-400',
    };

    return (
        <div className="rounded border border-gray-300 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
            <div className="text-[11px] font-semibold text-gray-600 dark:text-gray-400">{label}</div>
            <div className={`mt-1 text-xl font-semibold ${tones[tone] || ''}`}>{value}</div>
        </div>
    );
}

export function TextInput(props) {
    return (
        <input
            {...props}
            className={`h-9 w-full rounded border border-gray-300 bg-white px-3 text-sm text-gray-900 outline-none focus:border-gray-700 dark:border-gray-600 dark:bg-gray-950 dark:text-gray-100 dark:focus:border-gray-400 ${props.className || ''}`}
        />
    );
}

export function Field({ label, children, error }) {
    return (
        <label className="block space-y-1.5 text-sm">
            <span className="font-medium text-gray-700 dark:text-gray-300">{label}</span>
            {children}
            {error && <span className="block text-xs text-red-600">{error}</span>}
        </label>
    );
}

export function Modal({ open, onClose, title, subtitle, wide, children, footer }) {
    if (!open) return null;

    return (
        <div className="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-black/40 p-4 sm:items-center" onClick={onClose}>
            <div
                className={`my-4 w-full rounded border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900 ${wide ? 'max-w-6xl' : 'max-w-lg'}`}
                onClick={(e) => e.stopPropagation()}
            >
                <div className="flex items-start justify-between gap-3 border-b border-gray-300 bg-gray-50 px-5 py-4 dark:border-gray-700 dark:bg-gray-800/70">
                    <div>
                        <h3 className="text-lg font-semibold text-green-700 dark:text-green-400">{title}</h3>
                        {subtitle && <p className="text-xs text-gray-500 dark:text-gray-400">{subtitle}</p>}
                    </div>
                    <button type="button" onClick={onClose} className="rounded px-2 py-1 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">
                        ✕
                    </button>
                </div>
                <div className="px-5 py-4 text-gray-900 dark:text-gray-100">{children}</div>
                {footer && (
                    <div className="flex flex-wrap justify-end gap-2 border-t border-gray-300 bg-gray-50 px-5 py-4 dark:border-gray-700 dark:bg-gray-800/70">
                        {footer}
                    </div>
                )}
            </div>
        </div>
    );
}
