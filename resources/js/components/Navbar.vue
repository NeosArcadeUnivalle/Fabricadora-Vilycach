<template>
    <nav v-if="!shouldHideNavbar && isAuthenticated" class="navbar-container">
        <div class="navbar">
            <div class="navbar-left">
                <a class="navbar-logo">
                    <img src="/img/logo-fotor-2024092416012.png" alt="Logo" class="logo-img">
                </a>
            </div>
            <div class="navbar-right">
                <ul class="navbar-links">
                    <li><a :href="routes.bi">ANÁLISIS</a></li>
                    <li><a :href="routes.empleados">EMPLEADOS</a></li>
                    <li><a :href="routes.productos">PRODUCTOS</a></li>
                    <li><a :href="routes.produccion">PRODUCCIÓN</a></li>
                    <li><a :href="routes.materiaPrima">MATERIA PRIMA</a></li>
                    <li><a :href="routes.ventas">VENTAS</a></li>
                    <li>
                        <button @click="handleLogout" class="logout-btn">CERRAR SESIÓN</button>
                    </li>
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
            isAuthenticated: true,
            shouldHideNavbar: false,
            routes: {
                bi: '/bi',
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
        handleLogout() {
            fetch('/empleado/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                if (response.ok) {
                    this.isAuthenticated = false;
                    window.location.href = this.routes.login;
                }
            }).catch(err => {
                console.error('Error al cerrar sesión:', err);
            });
        }
    },
    mounted() {
        this.isAuthenticated = !!document.querySelector('meta[name="csrf-token"]');
        const path = window.location.pathname;
        this.shouldHideNavbar = path.includes('/empleado/login') || path.includes('/create') || path.includes('/edit');
    }
};
</script>

<style scoped>
.navbar-links {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    align-items: center;
}

.navbar-links li {
    margin: 0 10px;
}

.navbar-links a {
    text-decoration: none;
    color: #8b0000;
    font-weight: bold;
    padding: 8px 12px;
    transition: background 0.3s, color 0.3s;
}

.navbar-links a:hover {
    background: #b22222;
    color: white;
    border-radius: 4px;
}

.logout-btn {
    background: #b22222;
    color: white;
    border: none;
    padding: 8px 12px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 4px;
    transition: background 0.3s, color 0.3s;
    margin: 0; 
}

.logout-btn:hover {
    background: #8b0000;
}
</style>