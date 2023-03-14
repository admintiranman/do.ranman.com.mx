<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('enabled')->default(false);
            $table->unsignedBigInteger('job_id')->nullable();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('udn_id');
            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('report_to')->nullable();   // boss         



            $table->foreign('user_id')->references('id')->on('users');        
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('udn_id')->references('id')->on('udns');
            $table->foreign('level_id')->references('id')->on('levels');
        });
        // Schema::table('profiles', function($table) {
        //     // profile
        //     $table->foreign('report_to')->references('report_id')->on('profiles');
        // });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {            
            $table->dropForeign('user_id');
            $table->dropForeign('job_id');
            $table->dropForeign('level_id');
            $table->dropForeign('udn_id');            
            $table->dropForeign('report_to');
        });
        Schema::dropIfExists('profiles');
    }
}
