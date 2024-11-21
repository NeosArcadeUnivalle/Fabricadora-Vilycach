<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EncryptEmployeePasswords extends Command
{
    protected $signature = 'encrypt:employee-passwords';
    protected $description = 'Encripta todas las contraseñas de la tabla empleados si no están encriptadas';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $empleados = DB::table('empleados')->get();

        foreach ($empleados as $empleado) {
            if (Hash::needsRehash($empleado->password)) {
                DB::table('empleados')
                    ->where('idEmpleado', $empleado->idEmpleado)
                    ->update(['password' => Hash::make($empleado->password)]);

                $this->info("Contraseña del empleado con ID {$empleado->idEmpleado} encriptada correctamente.");
            }
        }

        $this->info('Encriptación de contraseñas completada.');
    }
}