<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsummaries', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->unsignedBigInteger('summary_id');
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
        Schema::table('subsummaries', function (Blueprint $table) {
            $table->dropForeign('summary_id');
        });
        Schema::dropIfExists('subsummaries');
    }
}
