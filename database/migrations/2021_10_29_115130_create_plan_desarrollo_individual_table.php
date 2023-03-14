<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanDesarrolloIndividualTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('planes_desarrollo_individual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');    
            $table->unsignedBigInteger('ev_control_id');


            // history data 
            $table->string('employee_name');
            $table->string('job');
            $table->string('boss');
            $table->string('udn');
            $table->string('level');
            $table->string("departamento");
            $table->smallInteger('avance')->default(0);





            $table->json('body');
            $table->text('comentarios')->nullable();
            $table->boolean('lock')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->string('sign_boss')->nullable();
            $table->dateTime('sign_boss_datetime')->nullable();
            $table->string('sign_employee')->nullable();
            $table->dateTime('sign_employee_datetime')->nullable();


            $table->foreign('ev_control_id')->references('id')->on('ev_controls');
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planes_desarrollo_individual', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('planes_desarrollo_individual');
    }
}
