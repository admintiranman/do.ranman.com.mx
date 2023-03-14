<?php

use App\Models\Evaluation;
use App\Models\EvControl;
use App\Models\Objective;
use App\Models\PlanDesarrolloIndividual;
use App\Models\Retroalimentacion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvControlRestructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Actualiza los datos 

        Schema::table("ev_controls", function(Blueprint $table) {
            $table->dropColumn("label_9box");
            $table->dropColumn("level_id");
        });


        // change the name firs item
        // EvControl::find(1)->update(["name" => "2022 INICIAL"]);


        // // update all 2022 inicial to ev control (1)

        // Evaluation::query()->update(["ev_control_id" => 1]);
        // Objective::query()->update(["ev_control_id" => 1]);
        // PlanDesarrolloIndividual::query()->update(["ev_control_id" => 1]);
        // Retroalimentacion::query()->update(["ev_control_id" => 1]);

        // // delete items 
        // EvControl::where("id", "<>", 1)->delete();        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
