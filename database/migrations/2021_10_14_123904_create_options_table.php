<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('summary_id');
            $table->string('text');
            $table->unsignedSmallInteger('value');
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('summary_id')->references('id')->on('summaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropForeign('summary_id');
        });
        Schema::dropIfExists('options');
    }
}
