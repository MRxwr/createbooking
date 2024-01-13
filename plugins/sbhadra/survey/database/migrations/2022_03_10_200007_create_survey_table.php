<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->string('slug', 250)->unique()->index();
            $table->integer('booking_id')->nullable(0);
            $table->string('customer_name', 100)->nullable('no');
            $table->string('customer_mobile', 15)->nullable('no');
            $table->longText('result')->nullable();
            $table->string('survey_coupon',25)->default(0);
            $table->string('status', 50)->default('no');
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
        Schema::dropIfExists('surveys');
    }
}
