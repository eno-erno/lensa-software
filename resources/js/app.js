import { createApp } from 'vue';
import App from './components/App.vue'; 
import vuetify from './plugins/vuetify';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import router from './router';


createApp(App)
    .use(vuetify)
    .use(router)
    .mount('#app');
