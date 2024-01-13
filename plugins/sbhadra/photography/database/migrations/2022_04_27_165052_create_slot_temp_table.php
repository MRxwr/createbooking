<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('package_id');
            $table->integer('timeslot_id');
            $table->string('booking_date')->nullable();
            $table->longText('session', 1000)->nullable();
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
        Schema::dropIfExists('slots_temp');
    }
}
