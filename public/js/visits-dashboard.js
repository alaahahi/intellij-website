const { createApp } = Vue;

const VisitsDashboard = {
    template: `
        <div class="visits-dashboard">
            <div class="container-fluid py-5">
                <div class="container">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="display-5">إحصائيات الزيارات</h1>
                        <button @click="refreshData" class="btn btn-primary" :disabled="loading">
                            <i class="fas fa-sync-alt" :class="{ 'fa-spin': loading }"></i> تحديث
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div v-if="loading && !stats" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">جاري التحميل...</span>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div v-if="stats" class="row g-4 mb-5">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">إجمالي الزيارات</h5>
                                    <h2 class="mb-0">{{ formatNumber(stats.total) }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">زيارات اليوم</h5>
                                    <h2 class="mb-0">{{ formatNumber(stats.today) }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">زيارات هذا الأسبوع</h5>
                                    <h2 class="mb-0">{{ formatNumber(stats.this_week) }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">زيارات هذا الشهر</h5>
                                    <h2 class="mb-0">{{ formatNumber(stats.this_month) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div v-if="stats" class="row g-4 mb-5">
                        <!-- Sources Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">الزيارات حسب المصدر</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>المصدر</th>
                                                <th>عدد الزيارات</th>
                                                <th>النسبة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="source in stats.sources" :key="source.source">
                                                <td>
                                                    <i v-if="source.source === 'google'" class="fab fa-google text-danger"></i>
                                                    <i v-else-if="source.source === 'facebook'" class="fab fa-facebook text-primary"></i>
                                                    <i v-else class="fas fa-link"></i>
                                                    {{ getSourceName(source.source) }}
                                                </td>
                                                <td>{{ formatNumber(source.total) }}</td>
                                                <td>
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar" 
                                                             :style="{ width: (source.total / stats.total * 100) + '%' }">
                                                            {{ ((source.total / stats.total) * 100).toFixed(1) }}%
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Pages Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">أكثر الصفحات زيارة</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>الصفحة</th>
                                                <th>عدد الزيارات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="page in stats.pages" :key="page.page">
                                                <td>{{ page.page || '/' }}</td>
                                                <td>{{ formatNumber(page.total) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form @submit.prevent="applyFilters" class="row g-3">
                                <div class="col-md-3">
                                    <select v-model="filters.source" class="form-select">
                                        <option value="">جميع المصادر</option>
                                        <option value="google">Google</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="direct">مباشر</option>
                                        <option value="other">أخرى</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" v-model="filters.date_from" class="form-control" placeholder="من تاريخ">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" v-model="filters.date_to" class="form-control" placeholder="إلى تاريخ">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100" :disabled="loading">
                                        <i class="fas fa-search"></i> بحث
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Visits Table -->
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">سجل الزيارات</h5>
                        </div>
                        <div class="card-body">
                            <div v-if="loading" class="text-center py-3">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">جاري التحميل...</span>
                                </div>
                            </div>
                            <div v-else>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>التاريخ والوقت</th>
                                                <th>المصدر</th>
                                                <th>الصفحة</th>
                                                <th>IP</th>
                                                <th>الجهاز</th>
                                                <th>المتصفح</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="visit in visits.data" :key="visit.id">
                                                <td>{{ visit.id }}</td>
                                                <td>{{ formatDate(visit.visited_at) }}</td>
                                                <td>
                                                    <span :class="getSourceBadgeClass(visit.source)">
                                                        <i :class="getSourceIcon(visit.source)"></i>
                                                        {{ getSourceName(visit.source) }}
                                                    </span>
                                                </td>
                                                <td>{{ visit.page || '/' }}</td>
                                                <td>{{ visit.ip_address }}</td>
                                                <td>
                                                    <i :class="getDeviceIcon(visit.device)"></i>
                                                    {{ getDeviceName(visit.device) }}
                                                </td>
                                                <td>{{ visit.browser ? visit.browser.charAt(0).toUpperCase() + visit.browser.slice(1) : '-' }}</td>
                                            </tr>
                                            <tr v-if="visits.data && visits.data.length === 0">
                                                <td colspan="7" class="text-center">لا توجد زيارات مسجلة</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div v-if="visits && visits.last_page > 1" class="d-flex justify-content-center mt-4">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" :class="{ disabled: visits.current_page === 1 }">
                                                <a class="page-link" href="#" @click.prevent="loadPage(visits.current_page - 1)">السابق</a>
                                            </li>
                                            <li v-for="page in getPageNumbers()" :key="page" 
                                                class="page-item" 
                                                :class="{ active: page === visits.current_page, disabled: page === '...' }">
                                                <a v-if="page !== '...'" class="page-link" href="#" @click.prevent="loadPage(page)">{{ page }}</a>
                                                <span v-else class="page-link">...</span>
                                            </li>
                                            <li class="page-item" :class="{ disabled: visits.current_page === visits.last_page }">
                                                <a class="page-link" href="#" @click.prevent="loadPage(visits.current_page + 1)">التالي</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
    data() {
        return {
            loading: false,
            stats: null,
            visits: {
                data: [],
                current_page: 1,
                last_page: 1,
                per_page: 50,
                total: 0
            },
            filters: {
                source: '',
                date_from: '',
                date_to: ''
            }
        };
    },
    mounted() {
        this.loadData();
        // Auto refresh every 30 seconds
        setInterval(() => {
            this.loadData();
        }, 30000);
    },
    methods: {
        async loadData() {
            this.loading = true;
            try {
                await Promise.all([
                    this.loadStats(),
                    this.loadVisits()
                ]);
            } catch (error) {
                console.error('Error loading data:', error);
                alert('حدث خطأ أثناء تحميل البيانات');
            } finally {
                this.loading = false;
            }
        },
        async loadStats() {
            try {
                const response = await axios.get('/api/visits/stats');
                this.stats = response.data;
            } catch (error) {
                console.error('Error loading stats:', error);
            }
        },
        async loadVisits(page = 1) {
            try {
                const params = {
                    page: page,
                    per_page: this.visits.per_page,
                    ...this.filters
                };
                // Remove empty filters
                Object.keys(params).forEach(key => {
                    if (params[key] === '' || params[key] === null) {
                        delete params[key];
                    }
                });
                const response = await axios.get('/api/visits/list', { params });
                this.visits = response.data;
            } catch (error) {
                console.error('Error loading visits:', error);
            }
        },
        applyFilters() {
            this.loadVisits(1);
        },
        loadPage(page) {
            if (page >= 1 && page <= this.visits.last_page) {
                this.loadVisits(page);
            }
        },
        refreshData() {
            this.loadData();
        },
        formatNumber(num) {
            return new Intl.NumberFormat('ar-SA').format(num);
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('ar-SA', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            });
        },
        getSourceName(source) {
            const names = {
                'google': 'Google',
                'facebook': 'Facebook',
                'direct': 'مباشر',
                'other': 'أخرى'
            };
            return names[source] || source;
        },
        getSourceIcon(source) {
            const icons = {
                'google': 'fab fa-google',
                'facebook': 'fab fa-facebook',
                'direct': 'fas fa-link'
            };
            return icons[source] || 'fas fa-globe';
        },
        getSourceBadgeClass(source) {
            const classes = {
                'google': 'badge bg-danger',
                'facebook': 'badge bg-primary',
                'direct': 'badge bg-secondary'
            };
            return classes[source] || 'badge bg-info';
        },
        getDeviceIcon(device) {
            const icons = {
                'mobile': 'fas fa-mobile-alt',
                'tablet': 'fas fa-tablet-alt',
                'desktop': 'fas fa-desktop'
            };
            return icons[device] || 'fas fa-desktop';
        },
        getDeviceName(device) {
            const names = {
                'mobile': 'Mobile',
                'tablet': 'Tablet',
                'desktop': 'Desktop'
            };
            return names[device] || 'Desktop';
        },
        getPageNumbers() {
            const pages = [];
            const current = this.visits.current_page;
            const last = this.visits.last_page;
            
            if (last <= 7) {
                for (let i = 1; i <= last; i++) {
                    pages.push(i);
                }
            } else {
                if (current <= 3) {
                    for (let i = 1; i <= 5; i++) {
                        pages.push(i);
                    }
                    pages.push('...');
                    pages.push(last);
                } else if (current >= last - 2) {
                    pages.push(1);
                    pages.push('...');
                    for (let i = last - 4; i <= last; i++) {
                        pages.push(i);
                    }
                } else {
                    pages.push(1);
                    pages.push('...');
                    for (let i = current - 1; i <= current + 1; i++) {
                        pages.push(i);
                    }
                    pages.push('...');
                    pages.push(last);
                }
            }
            return pages;
        }
    }
};

createApp({
    components: {
        VisitsDashboard
    },
    template: '<VisitsDashboard />'
}).mount('#visits-dashboard-app');
