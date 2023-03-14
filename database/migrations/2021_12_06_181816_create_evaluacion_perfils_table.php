<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionPerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_perfiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('ev_control_id');

            // history data 
            $table->string('employee_name');
            $table->string('job');
            $table->string('boss');
            $table->string('udn');
            $table->string('level');
            $table->string("departamento");
            


            $table->unsignedBigInteger('user_id');
            $table->string('evaluated_by')->nullable();
            $table->enum('status', ['Open', 'In-Progress', 'Close'])->default('Open');
            $table->string('current_section');   
            $table->json('evaluacion');         
            $table->timestamps();
            $table->boolean('lock')->default(false);
            $table->softDeletes();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ev_control_id')->references('id')->on('ev_controls');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluacion_perfiles');
    }
}
