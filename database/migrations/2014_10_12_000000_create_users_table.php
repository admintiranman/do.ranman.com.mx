<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // user
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('username_ad')->nullable();            
            $table->boolean('active')->default(true);
            $table->string("password")->nullable();

            // profile
            $table->integer('num_nomina')->nullable();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('udn_id')->nullable();
            $table->integer('report_id');
            $table->integer('report_to')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            
            // pc (puesto critico) | tc (talento clave)
            $table->boolean('puesto_critico')->default(0);
            $table->boolean('talento_clave')->default(0);


            // timestamps
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
