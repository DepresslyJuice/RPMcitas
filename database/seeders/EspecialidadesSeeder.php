<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSeeder extends Seeder
{
    public function run()
    {
        DB::table('especialidades')->insert([
            ['nombre' => 'Ortodoncia'],
            ['nombre' => 'Endodoncia'],
            ['nombre' => 'Cirugía Oral'],
            ['nombre' => 'Odontología General'],
        ]);
    }
}

