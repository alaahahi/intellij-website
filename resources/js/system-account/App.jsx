import React, { useCallback, useEffect, useState } from 'react';
import axios from 'axios';
import CompanyBar from './CompanyBar';
import Dashboard from './Dashboard';
import PinScreen from './PinScreen';
import TopNav, { consumeFocusTarget } from './TopNav';
import { useI18n } from './i18n/I18nProvider';

function getConfig() {
    const el = document.getElementById('system-account-root');
    if (!el) {
        return {
            slug: '',
            companyName: '',
            unlocked: false,
            hubMode: true,
            baseUrl: '',
            companiesUrl: '/system-account/api/companies',
            companies: [],
        };
    }

    let companies = [];
    try {
        companies = JSON.parse(el.dataset.companies || '[]');
    } catch {
        companies = [];
    }

    return {
        slug: el.dataset.slug || '',
        companyName: el.dataset.companyName || '',
        unlocked: el.dataset.unlocked === '1',
        hubMode: el.dataset.hubMode === '1' || !el.dataset.slug,
        baseUrl: el.dataset.baseUrl || '',
        companiesUrl: el.dataset.companiesUrl || '/system-account/api/companies',
        companies,
    };
}

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;
const token = document.querySelector('meta[name="csrf-token"]')?.content;
if (token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

export default function App() {
    const { t } = useI18n();
    const config = getConfig();
    const [unlocked, setUnlocked] = useState(config.unlocked);
    const [companyName, setCompanyName] = useState(config.companyName);
    const [companies, setCompanies] = useState(config.companies || []);
    const [batches, setBatches] = useState([]);
    const [remittances, setRemittances] = useState([]);
    const [stats, setStats] = useState({});
    const [loading, setLoading] = useState(false);
    const [bootLoading, setBootLoading] = useState(config.unlocked && !!config.slug);
    const [unlocking, setUnlocking] = useState(false);
    const [creatingCompany, setCreatingCompany] = useState(false);
    const [deletingCompany, setDeletingCompany] = useState(false);
    const [pinError, setPinError] = useState('');
    const [toast, setToast] = useState('');
    const [focusOnce] = useState(() => consumeFocusTarget());

    const showToast = (msg) => {
        setToast(msg);
        setTimeout(() => setToast(''), 2500);
    };

    const refreshCompanies = useCallback(async () => {
        try {
            const { data } = await axios.get(config.companiesUrl);
            setCompanies(data.data || []);
        } catch {
            // ignore
        }
    }, [config.companiesUrl]);

    const loadData = useCallback(async () => {
        if (!config.slug || !config.baseUrl) return;
        setLoading(true);
        try {
            const { data } = await axios.get(`${config.baseUrl}/api/dashboard`);
            setBatches(data.batches || []);
            setRemittances(data.remittances || []);
            setStats(data.stats || {});
        } catch (err) {
            if (err.response?.status === 401) {
                setUnlocked(false);
            } else {
                showToast(err.response?.data?.message || t('toastLoadedFail'));
            }
        } finally {
            setLoading(false);
            setBootLoading(false);
        }
    }, [config.baseUrl, config.slug]);

    useEffect(() => {
        refreshCompanies();
    }, [refreshCompanies]);

    useEffect(() => {
        if (unlocked && config.slug) loadData();
        else setBootLoading(false);
    }, [unlocked, loadData, config.slug]);

    const unlock = async (pin) => {
        setUnlocking(true);
        setPinError('');
        try {
            const { data } = await axios.post(`${config.baseUrl}/unlock`, { pin });
            setUnlocked(true);
            setBootLoading(true);
            setCompanyName(data.company_name || companyName);
            showToast(t('toastLoginOk'));
        } catch (err) {
            setPinError(err.response?.data?.message || t('toastLoginFail'));
        } finally {
            setUnlocking(false);
        }
    };

    const lock = async () => {
        await axios.post(`${config.baseUrl}/lock`);
        setUnlocked(false);
        setBatches([]);
        setRemittances([]);
        setStats({});
        showToast(t('toastLocked'));
    };

    const createCompany = async ({ name, slug, pin }) => {
        setCreatingCompany(true);
        try {
            const { data } = await axios.post(config.companiesUrl, { name, slug, pin });
            setCompanies(data.data || []);
            showToast(t('toastCompanyCreated'));
            window.location.href = data.url;
        } finally {
            setCreatingCompany(false);
        }
    };

    const deleteCompany = async ({ slug, password }) => {
        setDeletingCompany(true);
        try {
            const { data } = await axios.delete(`${config.companiesUrl}/${encodeURIComponent(slug)}`, {
                data: { password },
            });
            setCompanies(data.data || []);
            showToast(data.message || t('toastCompanyDeleted'));
            window.location.href = data.redirect || '/system-account';
        } finally {
            setDeletingCompany(false);
        }
    };

    const applyPayload = (data) => {
        if (data.batches) setBatches(data.batches);
        if (data.data) setRemittances(data.data);
        if (data.remittances) setRemittances(data.remittances);
        if (data.stats) setStats(data.stats);
    };

    const api = {
        addBatch: async (payload) => {
            const { data } = await axios.post(`${config.baseUrl}/api/batches`, payload);
            applyPayload(data);
            showToast(t('toastBatchAdded'));
        },
        updateBatch: async (id, payload) => {
            try {
                const { data } = await axios.put(`${config.baseUrl}/api/batches/${id}`, payload);
                applyPayload(data);
                showToast(t('toastBatchUpdated'));
                return true;
            } catch (err) {
                showToast(err.response?.data?.message || t('toastBatchUpdateFail'));
                return false;
            }
        },
        deleteBatch: async (id) => {
            if (!window.confirm(t('toastConfirmBatchDelete'))) return;
            const { data } = await axios.delete(`${config.baseUrl}/api/batches/${id}`);
            applyPayload(data);
            showToast(t('toastBatchDeleted'));
        },
        loadVehicles: async (batchId) => {
            const { data } = await axios.get(`${config.baseUrl}/api/batches/${batchId}/vehicles`);
            return data;
        },
        addVehicle: async (batchId, payload) => {
            try {
                const { data } = await axios.post(`${config.baseUrl}/api/batches/${batchId}/vehicles`, payload);
                applyPayload(data);
                showToast(t('toastVehicleAdded'));
                return data.vehicles;
            } catch (err) {
                showToast(err.response?.data?.message || t('toastVehicleAddFail'));
                return null;
            }
        },
        updateVehicle: async (batchId, id, payload) => {
            try {
                const { data } = await axios.put(`${config.baseUrl}/api/batches/${batchId}/vehicles/${id}`, payload);
                applyPayload(data);
                showToast(t('toastVehicleUpdated'));
                return data.vehicles;
            } catch (err) {
                showToast(err.response?.data?.message || t('toastVehicleUpdateFail'));
                return null;
            }
        },
        deleteVehicle: async (batchId, id) => {
            if (!window.confirm(t('toastConfirmVehicleDelete'))) return null;
            const { data } = await axios.delete(`${config.baseUrl}/api/batches/${batchId}/vehicles/${id}`);
            applyPayload(data);
            showToast(t('toastVehicleDeleted'));
            return data.vehicles;
        },
        importVehicles: async (batchId, file) => {
            try {
                const form = new FormData();
                form.append('file', file);
                const { data } = await axios.post(`${config.baseUrl}/api/batches/${batchId}/vehicles/import`, form);
                applyPayload(data);
                showToast(t('toastImported', { n: data.imported }));
                return data.vehicles;
            } catch (err) {
                showToast(err.response?.data?.message || t('toastImportFail'));
                return null;
            }
        },
        importVehiclesText: async (batchId, rows) => {
            try {
                const { data } = await axios.post(`${config.baseUrl}/api/batches/${batchId}/vehicles/import-text`, { rows });
                applyPayload(data);
                showToast(t('toastImported', { n: data.imported }));
                return data.vehicles;
            } catch (err) {
                showToast(err.response?.data?.message || t('toastImportFail'));
                return null;
            }
        },
        addRemittance: async (payload) => {
            const { data } = await axios.post(`${config.baseUrl}/api/remittances`, payload);
            applyPayload(data);
            showToast(t('toastRemAdded'));
        },
        updateRemittance: async (id, payload) => {
            try {
                const { data } = await axios.put(`${config.baseUrl}/api/remittances/${id}`, payload);
                applyPayload(data);
                showToast(t('toastRemUpdated'));
                return true;
            } catch (err) {
                showToast(err.response?.data?.message || t('toastRemUpdateFail'));
                return false;
            }
        },
        deleteRemittance: async (id) => {
            if (!window.confirm(t('toastConfirmRemDelete'))) return;
            const { data } = await axios.delete(`${config.baseUrl}/api/remittances/${id}`);
            applyPayload(data);
            showToast(t('toastRemDeleted'));
        },
        exportExcel: () => {
            window.location.href = `${config.baseUrl}/api/export`;
        },
    };

    const shell = (content) => (
        <div className="min-h-screen bg-gray-100 dark:bg-gray-950">
            <TopNav currentSlug={config.slug} companiesUrl={config.companiesUrl} />
            <CompanyBar
                companies={companies}
                currentSlug={config.slug}
                onCreate={createCompany}
                onDelete={deleteCompany}
                creating={creatingCompany}
                deleting={deletingCompany}
            />
            {content}
            {toast && <Toast message={toast} />}
        </div>
    );

    if (bootLoading) {
        return shell(
            <div className="flex items-center justify-center py-24">
                <div className="rounded border border-gray-300 bg-white px-6 py-5 text-sm text-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    {t('loadingSystem')}
                </div>
            </div>,
        );
    }

    if (config.hubMode || !config.slug) {
        return shell(
            <div className="mx-auto max-w-lg px-4 py-16 text-center">
                <h1 className="mb-2 text-xl font-semibold text-gray-900 dark:text-gray-100">{t('hubTitle')}</h1>
                <p className="mb-6 text-sm text-gray-600 dark:text-gray-400">{t('hubEmpty')}</p>
            </div>,
        );
    }

    if (!unlocked) {
        return shell(
            <PinScreen companyName={companyName} onUnlock={unlock} unlocking={unlocking} error={pinError} />,
        );
    }

    return shell(
        <Dashboard
            companyName={companyName}
            batches={batches}
            remittances={remittances}
            stats={stats}
            loading={loading}
            onRefresh={loadData}
            onLock={lock}
            baseUrl={config.baseUrl}
            api={api}
            initialFocus={focusOnce}
        />,
    );
}

function Toast({ message }) {
    return (
        <div className="fixed bottom-5 left-1/2 z-[60] -translate-x-1/2 rounded border border-gray-800 bg-gray-900 px-4 py-2 text-sm text-white shadow">
            {message}
        </div>
    );
}
