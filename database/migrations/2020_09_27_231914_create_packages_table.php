<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->default('default.png');
            $table->integer('manager_num');
            $table->integer('employee_num');
            $table->integer('monitor_num');
            $table->integer('trial_days');
            $table->integer('end_days');
            $table->integer('days');
            $table->integer('price');
            $table->timestamps();
        });

        Schema::create('package_translations', function(Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');

            $table->unique(['package_id', 'locale']);
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
