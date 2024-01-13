<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->longText('content', 1000)->nullable();
            $table->longText('short_description', 500)->nullable();
            $table->string('thumbnail', 250)->nullable();
            $table->string('slug', 250)->unique()->index();
            $table->tinyInteger('is_extra')->default(0);
            $table->string('time', 25)->nullable();
            $table->decimal('price', 10,2)->default('0.00');
            $table->string('currency', 50)->default('KD');
            $table->string('status', 50)->default('draft');
            $table->bigInteger('views')->default(0);
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
        Schema::dropIfExists('packages');
    }
}
