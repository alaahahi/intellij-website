import React, { useCallback, useEffect, useState } from 'react';
import axios from 'axios';
import Dashboard from './Dashboard';
import PinScreen from './PinScreen';

function getConfig() {
    const el = document.getElementById('system-account-root');
    return {
        slug: el.dataset.slug,
        companyName: el.dataset.companyName,
        unlocked: el.dataset.unlocked === '1',
        baseUrl: el.dataset.baseUrl,
    };
}

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.querySelector('meta[name="csrf-token"]')?.content;
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

export default function App() {
    const config = getConfig();
    const [unlocked, setUnlocked] = useState(config.unlocked);
    const [companyName, setCompanyName] = useState(config.companyName);
    const [cars, setCars] = useState([]);
    const [stats, setStats] = useState({});
    const [loading, setLoading] = useState(false);
    const [unlocking, setUnlocking] = useState(false);
    const [pinError, setPinError] = useState('');

    const loadCars = useCallback(async () => {
        setLoading(true);
        try {
            const { data } = await axios.get(`${config.baseUrl}/api/cars`);
            setCars(data.data || []);
            setStats(data.stats || {});
        } catch (err) {
            if (err.response?.status === 401) {
                setUnlocked(false);
            }
        } finally {
            setLoading(false);
        }
    }, [config.baseUrl]);

    useEffect(() => {
        if (unlocked) {
            loadCars();
        }
    }, [unlocked, loadCars]);

    const unlock = async (pin) => {
        setUnlocking(true);
        setPinError('');
        try {
            const { data } = await axios.post(`${config.baseUrl}/unlock`, { pin });
            setUnlocked(true);
            setCompanyName(data.company_name || companyName);
        } catch (err) {
            setPinError(err.response?.data?.message || 'فشل الدخول');
        } finally {
            setUnlocking(false);
        }
    };

    const lock = async () => {
        await axios.post(`${config.baseUrl}/lock`);
        setUnlocked(false);
        setCars([]);
        setStats({});
    };

    const addCar = async (payload) => {
        const { data } = await axios.post(`${config.baseUrl}/api/cars`, payload);
        setCars(data.data || []);
        setStats(data.stats || {});
    };

    const deleteCar = async (id) => {
        if (!window.confirm('حذف هذا الصف؟')) return;
        const { data } = await axios.delete(`${config.baseUrl}/api/cars/${id}`);
        setCars(data.data || []);
        setStats(data.stats || {});
    };

    const importExcel = async (file) => {
        const form = new FormData();
        form.append('file', file);
        const { data } = await axios.post(`${config.baseUrl}/api/cars/import`, form);
        setCars(data.data || []);
        setStats(data.stats || {});
        alert(`تم استيراد ${data.imported} صف`);
    };

    const exportExcel = () => {
        window.location.href = `${config.baseUrl}/api/cars/export`;
    };

    if (!unlocked) {
        return (
            <PinScreen
                companyName={companyName}
                onUnlock={unlock}
                unlocking={unlocking}
                error={pinError}
            />
        );
    }

    return (
        <Dashboard
            companyName={companyName}
            cars={cars}
            stats={stats}
            loading={loading}
            onRefresh={loadCars}
            onAdd={addCar}
            onDelete={deleteCar}
            onImport={importExcel}
            onExport={exportExcel}
            onLock={lock}
            baseUrl={config.baseUrl}
        />
    );
}
