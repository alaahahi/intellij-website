import React, { useEffect, useRef, useState } from 'react';
import { Card, ToolbarButton } from './ui';
import { useI18n } from './i18n/I18nProvider';

const LENGTH = 6;

export default function PinScreen({ companyName, onUnlock, unlocking, error }) {
    const { t } = useI18n();
    const [digits, setDigits] = useState(Array(LENGTH).fill(''));
    const inputsRef = useRef([]);

    useEffect(() => {
        inputsRef.current[0]?.focus();
    }, []);

    useEffect(() => {
        if (error) {
            setDigits(Array(LENGTH).fill(''));
            setTimeout(() => inputsRef.current[0]?.focus(), 0);
        }
    }, [error]);

    const value = digits.join('');

    const commit = (nextDigits) => {
        const pin = nextDigits.join('');
        if (pin.length === LENGTH && !unlocking) onUnlock(pin);
    };

    const updateAt = (index, raw) => {
        const char = (raw || '').replace(/\D/g, '').slice(-1);
        const next = [...digits];
        next[index] = char;
        setDigits(next);
        if (char && index < LENGTH - 1) inputsRef.current[index + 1]?.focus();
        if (next.every((d) => d !== '')) commit(next);
    };

    const onKeyDown = (index, e) => {
        if (e.key === 'Backspace') {
            e.preventDefault();
            const next = [...digits];
            if (next[index]) {
                next[index] = '';
                setDigits(next);
            } else if (index > 0) {
                next[index - 1] = '';
                setDigits(next);
                inputsRef.current[index - 1]?.focus();
            }
        }
        if (e.key === 'Enter' && value.length === LENGTH) {
            e.preventDefault();
            onUnlock(value);
        }
    };

    const onPaste = (e) => {
        e.preventDefault();
        const pasted = (e.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, LENGTH);
        if (!pasted) return;
        const next = Array(LENGTH).fill('');
        pasted.split('').forEach((ch, i) => { next[i] = ch; });
        setDigits(next);
        inputsRef.current[Math.min(pasted.length, LENGTH - 1)]?.focus();
        if (pasted.length === LENGTH) commit(next);
    };

    const borderClass = error
        ? 'border-red-500 ring-2 ring-red-200'
        : 'border-gray-300 focus:border-gray-800 focus:ring-1 focus:ring-gray-300';

    return (
        <div className="flex min-h-[70vh] items-center justify-center px-4 py-10">
            <Card className="w-full max-w-md p-6">
                <div className="mb-6 text-center">
                    <div className="brand-bg mx-auto mb-3 flex size-11 items-center justify-center rounded text-lg font-bold">B</div>
                    <h1 className="text-xl font-semibold text-green-700 dark:text-green-400">{companyName}</h1>
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">{t('pinHint')}</p>
                </div>

                <form
                    onSubmit={(e) => {
                        e.preventDefault();
                        if (value.length === LENGTH) onUnlock(value);
                    }}
                    className="space-y-4"
                >
                    <div className="flex justify-center gap-2" dir="ltr" onPaste={onPaste}>
                        {digits.map((digit, index) => (
                            <input
                                key={index}
                                ref={(el) => { inputsRef.current[index] = el; }}
                                type="password"
                                inputMode="numeric"
                                autoComplete="one-time-code"
                                maxLength={1}
                                value={digit}
                                disabled={unlocking}
                                onChange={(e) => updateAt(index, e.target.value)}
                                onKeyDown={(e) => onKeyDown(index, e)}
                                className={`h-12 w-10 rounded border bg-white text-center text-lg font-semibold outline-none transition ${borderClass}`}
                            />
                        ))}
                    </div>

                    {error ? (
                        <p className="rounded border border-red-200 bg-red-50 px-3 py-2 text-center text-sm font-medium text-red-700">{error}</p>
                    ) : (
                        <p className="text-center text-xs text-gray-400">{t('pinAuto')}</p>
                    )}

                    <ToolbarButton primary className="h-10 w-full justify-center text-sm" disabled={unlocking || value.length !== LENGTH}>
                        {unlocking ? t('verifying') : t('login')}
                    </ToolbarButton>
                </form>
            </Card>
        </div>
    );
}
