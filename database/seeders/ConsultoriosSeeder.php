<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultoriosSeeder extends Seeder
{
    public function run()
    {
        DB::table('consultorios')->insert([
            ['nombre' => 'Consultorio 1', 'direccion' => 'Calle Principal 123'],
            ['nombre' => 'Consultorio 2', 'direccion' => 'Avenida Secundaria 456'],
            ['nombre' => 'Consultorio 3', 'direccion' => 'Plaza Central 789'],
        ]);
    }
}

