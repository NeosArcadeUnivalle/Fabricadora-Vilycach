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
                <input type="password" v-model="password" required />

                <button type="submit">Iniciar Sesión</button>
            </form>
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
            errors: [],
        };
    },
    methods: {
        loginEmpleado() {
    this.errors = []; // Limpiar errores previos

    axios.post('/empleado/login', {
        correoElectronico: this.correoElectronico,
        password: this.password,
    })
    .then(response => {
        if (response.data.redirect) {
            window.location.href = response.data.redirect; // Redirige a productos si el login es exitoso
        }
    })
    .catch(error => {
        if (error.response && error.response.data.errors) {
            this.errors = Object.values(error.response.data.errors).flat();
        } else {
            this.errors.push('Las credenciales no coinciden con nuestros registros.');
        }
    });
}
    }
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
</style>