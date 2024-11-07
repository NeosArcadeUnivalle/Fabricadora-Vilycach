import { createApp } from 'vue';
import EmpleadoLogin from './components/EmpleadoLogin.vue';
import Navbar from './components/Navbar.vue';
import '@fortawesome/fontawesome-free/css/all.min.css';
import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Instancia de Vue para el login
if (document.getElementById('login-app')) {
    const loginApp = createApp(EmpleadoLogin);
    loginApp.mount('#login-app');
}

// Instancia de Vue para el navbar
if (document.getElementById('navbar-app')) {
    const navbarApp = createApp(Navbar);
    navbarApp.mount('#navbar-app');
}