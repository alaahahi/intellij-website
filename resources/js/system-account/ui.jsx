import React from 'react';

export function PageHeader({ title, subtitle, actions }) {
    return (
        <div className="mb-4 flex flex-wrap items-start justify-between gap-3">
            <div>
                <h1 className="text-xl font-semibold tracking-tight">{title}</h1>
                {subtitle && <p className="text-sm text-zinc-500">{subtitle}</p>}
            </div>
            {actions && <div className="flex flex-wrap items-center gap-2">{actions}</div>}
        </div>
    );
}

export function ToolbarButton({ children, primary, danger, small, className = '', ...rest }) {
    const size = small ? 'h-7 px-2.5 text-[11px]' : 'h-8 px-3 text-xs';
    const tone = primary
        ? 'brand-bg border-transparent text-white hover:opacity-90'
        : danger
          ? 'border-red-200 bg-red-50 text-red-600 hover:bg-red-100'
          : 'bg-white hover:bg-zinc-100';

    return (
        <button
            type="button"
            className={`inline-flex items-center gap-1.5 rounded-md border font-medium whitespace-nowrap shadow-sm transition disabled:opacity-50 ${size} ${tone} ${className}`}
            {...rest}
        >
            {children}
        </button>
    );
}

export function Card({ children, className = '' }) {
    return <div className={`rounded-xl border border-zinc-200 bg-white shadow-sm ${className}`}>{children}</div>;
}

export function CardHeader({ title, subtitle, actions }) {
    return (
        <div className="flex items-start justify-between gap-3 border-b border-zinc-200 px-5 py-4">
            <div>
                <h3 className="font-semibold">{title}</h3>
                {subtitle && <p className="text-xs text-zinc-500">{subtitle}</p>}
            </div>
            {actions}
        </div>
    );
}

export function StatCard({ label, value, tone = 'default' }) {
    const tones = {
        default: '',
        red: 'text-red-600',
        green: 'text-green-600',
        orange: 'text-orange-500',
    };

    return (
        <div className="rounded-xl border border-zinc-200 bg-white px-4 py-3 shadow-sm">
            <div className="text-[11px] font-semibold">{label}</div>
            <div className={`mt-1 text-xl font-semibold ${tones[tone] || ''}`}>{value}</div>
        </div>
    );
}

export function TextInput(props) {
    return (
        <input
            {...props}
            className={`h-9 w-full rounded-md border border-zinc-200 bg-white px-3 text-sm shadow-sm outline-none focus:ring-1 focus:ring-zinc-400 ${props.className || ''}`}
        />
    );
}

export function Field({ label, children, error }) {
    return (
        <label className="block space-y-1.5 text-sm">
            <span className="font-medium text-zinc-700">{label}</span>
            {children}
            {error && <span className="block text-xs text-red-600">{error}</span>}
        </label>
    );
}
