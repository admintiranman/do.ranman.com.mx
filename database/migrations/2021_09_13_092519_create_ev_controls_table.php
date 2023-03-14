<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_controls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->string('name');       
            $table->string('label_9box')->nullable();        
            $table->text('description')->nullable();
            $table->boolean('lock_objectives')->default(false);
            $table->boolean('lock_ev_perfil')->default(false);
            $table->boolean('lock_ev_dp')->default(false);
            $table->boolean('lock_retro')->default(false);
            $table->boolean('lock_pdi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ev_controls');
    }
}
