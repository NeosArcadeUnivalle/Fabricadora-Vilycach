<template>
    <nav v-if="!shouldHideNavbar" class="navbar-container">
        <div class="navbar">
            <div class="navbar-left">
                <a href="/" class="navbar-logo">
                    <img src="/img/logo-fotor-2024092416012.png" alt="Logo" class="logo-img">
                </a>
            </div>
            <div class="navbar-right">
                <ul class="navbar-links">
                    <li><a :href="routes.empleados">EMPLEADOS</a></li>
                    <li><a :href="routes.productos">PRODUCTOS</a></li>
                    <li><a :href="routes.produccion">PRODUCCIÓN</a></li>
                    <li><a :href="routes.materiaPrima">MATERIA PRIMA</a></li>
                    <li><a :href="routes.ventas">VENTAS</a></li>
                    <li><a :href="routes.login">CERRAR SESIÓN</a></li>
                </ul>
                <button class="navbar-toggle" @click="toggleNavbar">&#9776;</button>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            isAuthenticated: false,
            shouldHideNavbar: false,
            routes: {
                empleados: '/empleados',
                productos: '/productos',
                produccion: '/produccion',
                materiaPrima: '/materiaprima',
                ventas: '/ventas',
                login: '/empleado/login',
            }
        };
    },
    methods: {
        toggleNavbar() {
            const links = document.querySelector('.navbar-links');
            links.classList.toggle('active');
        },
        logout() {
            document.getElementById('logout-form').submit();
        }
    },
    mounted() {
        this.isAuthenticated = !!document.querySelector('meta[name="csrf-token"]');
        
        // Detectar si la URL contiene '/login', '/create' o '/edit'
        const path = window.location.pathname;
        this.shouldHideNavbar = path.includes('/empleado/login') || path.includes('/create') || path.includes('/edit');
    }
};
</script>