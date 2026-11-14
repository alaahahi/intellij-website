import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './App';
import { I18nProvider, useI18n } from './i18n/I18nProvider';
import { ThemeProvider } from './ThemeProvider';

class ErrorBoundary extends React.Component {
    constructor(props) {
        super(props);
        this.state = { error: null };
    }

    static getDerivedStateFromError(error) {
        return { error };
    }

    render() {
        if (this.state.error) {
            return <ErrorFallback error={this.state.error} />;
        }
        return this.props.children;
    }
}

function ErrorFallback({ error }) {
    const { t } = useI18n();
    return (
        <div style={{ fontFamily: 'sans-serif', padding: 32, direction: 'rtl', maxWidth: 640, margin: '40px auto' }}>
            <h2 style={{ color: '#b91c1c' }}>{t('uiError')}</h2>
            <p style={{ color: '#4b5563' }}>{String(error?.message || error)}</p>
            <button
                type="button"
                onClick={() => window.location.reload()}
                style={{ marginTop: 12, padding: '8px 14px', background: '#111827', color: '#fff', border: 0, borderRadius: 6 }}
            >
                {t('reload')}
            </button>
        </div>
    );
}

const el = document.getElementById('system-account-root');
if (el) {
    createRoot(el).render(
        <React.StrictMode>
            <ThemeProvider>
                <I18nProvider>
                    <ErrorBoundary>
                        <App />
                    </ErrorBoundary>
                </I18nProvider>
            </ThemeProvider>
        </React.StrictMode>,
    );
}
