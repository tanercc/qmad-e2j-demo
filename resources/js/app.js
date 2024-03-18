import './bootstrap';

import {createApp} from 'vue';
import DataGrid from "./components/DataGrid.vue";
import GanttChart from "./components/GanttChart.vue";
import { registerLicense } from '@syncfusion/ej2-base';

// Registering Syncfusion license key
registerLicense('Ngo9BigBOggjHTQxAR8/V1NBaF5cXmZCekx3QHxbf1x0ZFdMYFpbQHdPMyBoS35RckVgWHlfdnZQRGRYUUJ/');

const app = createApp({
    components: {
        DataGrid,
        GanttChart,
    },
});

app.mount('#app');
