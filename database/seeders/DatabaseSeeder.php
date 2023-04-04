<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        // $this->call(UserSeeder::class);
        $this->call(RolSeeder::class);
        
        
        // puestos 
        // $this->call(TMECPuestosSeeder::class);
        // $this->call(RTPuestosSeeder::class);
        // $this->call(WTCPuestosSeeder::class);
        // $this->call(VDCPuestosSeeder::class);
        // $this->call(METAPuestosSeeder::class);
        // $this->call(CORPPuestosSeeder::class);

        // competencias Culturales
        // $this->call(competencias_culturales_seeder::class);


        // encuestas
        // $this->call(director_survey_seeder::class);
        // $this->call(gerente_survey_seeder::class);
        // $this->call(coordinador_survey_seeder::class);
        // $this->call(especialista_survey_seeder::class);
        // $this->call(soporte_survey_seeder::class);

    }
}