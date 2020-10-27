<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file');

            $table->unsignedBigInteger('board_id')->nullable();
            $table->foreign('board_id')
                ->references('id')
                ->on('boards')
                ->onDelete('cascade');

            $table->unsignedBigInteger('very_small_board_id')->nullable();
            $table->foreign('very_small_board_id')
                ->references('id')
                ->on('very_small_boards')
                ->onDelete('cascade');

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
        Schema::dropIfExists('files');
    }
}
