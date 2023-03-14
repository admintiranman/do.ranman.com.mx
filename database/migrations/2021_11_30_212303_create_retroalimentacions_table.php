<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetroalimentacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retroalimentaciones', function (Blueprint $table) {
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





            $table->text('respuesta1')->default('');
            $table->text('respuesta2')->default('');
            $table->float('avance')->default(0);
            $table->boolean('lock')->default(false);
            $table->timestamps();
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
        Schema::dropIfExists('retroalimentaciones');
    }
}
