import { createApp } from 'vue';
import VisitsDashboard from './components/VisitsDashboard.vue';

const app = createApp({
    components: {
        VisitsDashboard
    }
});

app.mount('#visits-dashboard-app');
