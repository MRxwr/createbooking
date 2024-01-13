<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->string('slug', 250)->unique()->index();
            $table->integer('package_id');
            $table->string('transaction_id', 250)->nullable();
            $table->string('booking_date')->nullable();
            $table->integer('timeslot_id');
            $table->tinyInteger('is_filming')->default(0);
            $table->string('rating', 25)->nullable();
            $table->decimal('booking_price',10,2)->default(0.00);
            $table->string('customer_name', 100)->nullable();
            $table->string('mobile_number', 100)->nullable();
            $table->string('baby_name', 100)->nullable();
            $table->string('baby_age', 100)->nullable();
            $table->string('instructions')->nullable();
            $table->string('booking_notes')->nullable();
            $table->decimal('total_price',10,2)->default(0.00);
            $table->tinyInteger('sms')->default(0);
            $table->tinyInteger('refunded')->default(0);
            $table->string('status', 50)->default('yes');
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
        Schema::dropIfExists('bookings');
    }
}
