<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stringable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ConsultoriosSeeder::class,
            EspecialidadesSeeder::class,
            DoctoresSeeder::class,
            TipoCitasSeeder::class,
            PacientesSeeder::class,
            EstadoCitasSeeder::class,
            CitasSeeder::class,
        ]);
    }
}
