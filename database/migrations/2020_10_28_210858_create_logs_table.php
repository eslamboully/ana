<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('board_id');
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('log_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('log_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');

            $table->unique(['log_id', 'locale']);
            $table->foreign('log_id')->references('id')->on('logs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('log_translations');
    }
}
