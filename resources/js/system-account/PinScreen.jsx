import React, { useState } from 'react';
import { Card, Field, TextInput, ToolbarButton } from './ui';

export default function PinScreen({ companyName, onUnlock, unlocking, error }) {
    const [pin, setPin] = useState('');

    const submit = (e) => {
        e.preventDefault();
        onUnlock(pin);
    };

    return (
        <div className="flex min-h-screen items-center justify-center px-4">
            <Card className="w-full max-w-md p-6">
                <div className="mb-6 text-center">
                    <div className="brand-bg mx-auto mb-3 flex size-10 items-center justify-center rounded-lg text-lg font-bold text-white">
                        B
                    </div>
                    <h1 className="text-xl font-semibold">{companyName}</h1>
                    <p className="mt-1 text-sm text-zinc-500">أدخل رمز PIN للدخول إلى نظام الحساب</p>
                </div>

                <form onSubmit={submit} className="space-y-4">
                    <Field label="رمز PIN" error={error}>
                        <TextInput
                            type="password"
                            inputMode="numeric"
                            autoFocus
                            value={pin}
                            onChange={(e) => setPin(e.target.value)}
                            placeholder="••••"
                        />
                    </Field>
                    <ToolbarButton primary className="h-10 w-full justify-center text-sm" disabled={unlocking || !pin}>
                        {unlocking ? 'جاري التحقق...' : 'دخول'}
                    </ToolbarButton>
                </form>
            </Card>
        </div>
    );
}
