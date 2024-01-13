<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->string('slug', 250)->unique()->index();
            $table->string('coupon_code', 15)->unique();
            $table->decimal('coupon_discount', 10,2)->default('0.00');
            $table->tinyInteger('coupon_type')->default(0);
            $table->string('validity_from')->nullable();
            $table->string('validity_to')->nullable();
            $table->string('source')->default('system');
            $table->string('status')->default('yes');
            $table->timestamps();
        });
        Schema::table('bookings', function($table) {
            $table->string('coupon_code')->nullable();
            $table->string('referral_code')->nullable();
            $table->decimal('discount_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
