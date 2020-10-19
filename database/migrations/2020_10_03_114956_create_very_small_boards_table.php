<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerySmallBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('very_small_boards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('small_board_id');
            $table->foreign('small_board_id')
                ->references('id')
                ->on('small_boards')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('border')->nullable();
            $table->string('dueDate')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('very_small_boards');
    }
}
