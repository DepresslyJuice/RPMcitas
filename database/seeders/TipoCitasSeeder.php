<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCitasSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_citas')->insert([
            ['nombre' => 'Consulta General'],
            ['nombre' => 'Tratamiento'],
            ['nombre' => 'Control'],
        ]);
    }
}
