<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ev_control_id');
            $table->integer('year');
            
            // history data 
            $table->string('employee_name')->default('');
            $table->string('job')->default('');
            $table->string('boss')->default('');
            $table->string('udn')->default('');
            $table->string('level')->default('');
            $table->string("departamento")->default('');
            



            

            $table->unsignedBigInteger('user_id');            
            // start 
            $table->string('start_path')->nullable();
            $table->string('start_filename')->nullable();
            $table->text('start_comments')->nullable();
            
            // end 
            
            $table->string('end_path')->nullable();
            $table->string('end_filename')->nullable();                                
            $table->text('end_comments')->nullable();

            $table->boolean('start_lock')->default(false);
            $table->boolean('end_lock')->default(false);            
            
            
            $table->timestamps();
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
        Schema::table('objectives', function (Blueprint $table) {
            $table->dropForeign('profile_id');
            $table->dropForeign('ev_control_id');
        });
        Schema::dropIfExists('objectives');
    }
}
