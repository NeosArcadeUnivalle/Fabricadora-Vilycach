<template>
    <div class="login-page">
        <div class="login-container">
            <div class="logo-container">
                <img src="/img/logo-fotor-2024092416012.png" alt="Logo" class="logo">
            </div>
            <h2>Iniciar Sesión - Empleados</h2>

            <ul v-if="errors.length" class="error-list">
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>

            <form @submit.prevent="loginEmpleado">
                <label for="correoElectronico">Correo Electrónico:</label>
                <input type="email" v-model="correoElectronico" required />

                <label for="password">Contraseña:</label>
                <div class="password-container">
                    <input 
                        :type="showPassword ? 'text' : 'password'" 
                        v-model="password" 
                        required 
                    />
                    <span @click="togglePasswordVisibility" class="password-toggle">
                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </span>
                </div>

                <button type="submit">Iniciar Sesión</button>
            </form>
            <button @click="goToHome" class="back-btn">Regresar</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            correoElectronico: '',
            password: '',
            showPassword: false,
            errors: [],
            historyInterval: null,
        };
    },
    methods: {
        togglePasswordVisibility() {
            this.showPassword = !this.showPassword;
        },
        loginEmpleado() {
            this.errors = [];
            axios.post('/empleado/login', {
                correoElectronico: this.correoElectronico,
                password: this.password,
            })
            .then(response => {
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                }
            })
            .catch(error => {
                if (error.response && error.response.data.errors) {
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    this.errors.push('Las credenciales no coinciden con nuestros registros.');
                }
            });
        },
        goToHome() {
            window.location.href = '/';
        },
        preventBackNavigation() {
            history.pushState(null, null, location.href);
            window.addEventListener("popstate", () => {
                history.pushState(null, null, location.href);
                alert("No puedes retroceder en esta página.");
            });
        },
        maintainHistoryPosition() {
            this.historyInterval = setInterval(() => {
                history.pushState(null, null, location.href);
            }, 100);
        }
    },
    mounted() {
        this.preventBackNavigation();
        this.maintainHistoryPosition();
    },
    beforeDestroy() {
        if (this.historyInterval) {
            clearInterval(this.historyInterval);
        }
    },
};
</script>

<style scoped>
.login-page {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background-color: #f4f4f4;
}

.login-container {
    max-width: 400px;
    width: 100%;
    padding: 30px;
    background-color: #fff;
    border: 2px solid #b22222;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
}

h2 {
    color: #b22222;
    font-weight: bold;
    margin-bottom: 20px;
    font-size: 1.5em;
}

.error-list {
    color: #b22222;
    list-style-type: none;
    padding: 0;
    margin-bottom: 20px;
}

form label {
    display: block;
    color: #333;
    font-weight: bold;
    margin-bottom: 5px;
    text-align: left;
}

form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #b22222;
    border-radius: 4px;
    box-sizing: border-box;
}

.password-container {
    position: relative;
}

.password-toggle {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #333;
}

.password-toggle i {
    font-size: 1.2em;
}

form button {
    width: 100%;
    padding: 12px;
    background-color: #b22222;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #8b0000;
}

.back-btn {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #d3d3d3;
    color: #333;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.back-btn:hover {
    background-color: #a9a9a9;
}
</style>