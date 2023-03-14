<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Survey;


class SurveyRepair extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table("surveys", function(Blueprint $table) {

            $table->unsignedBigInteger("level_id")->nullable();
            $table->boolean("enabled")->default(true);   
        

            $table->foreign("level_id")->references("id")->on("levels");
        });
                
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
