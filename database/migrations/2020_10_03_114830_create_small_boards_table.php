<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmallBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_boards', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->unsignedBigInteger('board_id')->nullable();
            $table->foreign('board_id')
                ->references('id')
                ->on('boards')
                ->onDelete('cascade');

            $table->string('bg-color')->default('blue');
            $table->integer('count_number');

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
        Schema::dropIfExists('small_boards');
    }
}
