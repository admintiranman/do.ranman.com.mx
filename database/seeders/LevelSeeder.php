<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            ['name' => 'Coordinador'], 
            ['name' => 'Dirección'],
            ['name' => 'Soporte Administrativo'],
            ['name' => 'Especialistas'],
        ];
        foreach($levels as $l) { 
            Level::create($l);
        }
    }
}
