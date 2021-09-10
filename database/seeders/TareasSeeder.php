<?php

namespace Database\Seeders;

use App\Models\Tarea;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarea::create([
            'nombre' => 'Estudiar Programación',
            'descripcion' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, repudiandae!',
            'fecha' => Carbon::now(),
            'check' => true
        ]);
    }
}
