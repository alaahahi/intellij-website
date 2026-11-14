import React, { createContext, useCallback, useContext, useEffect, useMemo, useState } from 'react';

const STORAGE_KEY = 'system_account_theme';
const ThemeContext = createContext(null);

function readTheme() {
    try {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved === 'dark' || saved === 'light') return saved;
    } catch {
        // ignore
    }
    return 'light';
}

export function ThemeProvider({ children }) {
    const [theme, setThemeState] = useState(readTheme);

    const setTheme = useCallback((next) => {
        const value = next === 'dark' ? 'dark' : 'light';
        setThemeState(value);
        try {
            localStorage.setItem(STORAGE_KEY, value);
        } catch {
            // ignore
        }
    }, []);

    const toggleTheme = useCallback(() => {
        setTheme(theme === 'dark' ? 'light' : 'dark');
    }, [setTheme, theme]);

    useEffect(() => {
        document.documentElement.classList.toggle('dark', theme === 'dark');
    }, [theme]);

    const value = useMemo(
        () => ({ theme, setTheme, toggleTheme, isDark: theme === 'dark' }),
        [theme, setTheme, toggleTheme],
    );

    return <ThemeContext.Provider value={value}>{children}</ThemeContext.Provider>;
}

export function useTheme() {
    const ctx = useContext(ThemeContext);
    if (!ctx) throw new Error('useTheme must be used inside ThemeProvider');
    return ctx;
}
