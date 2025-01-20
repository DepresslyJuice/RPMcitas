<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCitasSeeder extends Seeder
{
    public function run()
    {
        DB::table('estado_citas')->insert([
            ['estado' => 'Pendiente'],
            ['estado' => 'Confirmada'],
            ['estado' => 'Cancelada'],
            ['estado' => 'Finalizada'],
        ]);
    }
}

