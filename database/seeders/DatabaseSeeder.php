<?php

namespace Database\Seeders;

use App\Models\User;
use EstadoCitasSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            ConsultoriosSeeder::class,
            EspecialidadesSeeder::class,
            DoctoresSeeder::class,
            PacientesSeeder::class,
            TipoCitasSeeder::class,
            CitasSeeder::class,
        ]);
    }
}
