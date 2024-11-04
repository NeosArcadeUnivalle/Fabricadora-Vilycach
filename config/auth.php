<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'empleados'), // Cambiar a empleados
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'empleados',  // Cambiar a empleados
        ],
    ],

    'providers' => [
        'empleados' => [  // Proveedor para empleados
            'driver' => 'eloquent',
            'model' => App\Models\Empleado::class,  // Usar el modelo Empleado
        ],
        // Proveedor adicional para usuarios estándar, si es necesario
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'empleados' => [ // Configuración de restablecimiento de contraseña para empleados
            'provider' => 'empleados',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        // Configuración de restablecimiento de contraseña para usuarios estándar
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];