<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();            
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('ev_control_id');
            $table->unsignedBigInteger('user_id');


            $table->string('name_survey');
            $table->text('description_survey')->nullable();

            // history data 
            $table->string('employee_name');
            $table->string('job');
            $table->string('boss');
            $table->string('udn');
            $table->string('level');
            $table->string("departamento");
            
            
            $table->enum('status', ['open', 'in progress', 'close'])->default('open');            
            $table->integer('x_rendimiento')->default(0);
            $table->integer('x_rendimiento_final')->default(0);

            $table->integer('y_potencial')->default(0);
            $table->integer('y_potencial_final')->default(0); 

            $table->json('survey');
            $table->string('current_section')->nullable();
            $table->boolean('lock')->default(false);            
            $table->timestamps();


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
        Schema::dropIfExists('evaluations');
    }
}
