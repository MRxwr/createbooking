<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->string('content', 200)->nullable();
            $table->string('thumbnail', 250)->nullable();
            $table->string('slug', 150)->unique()->index();
            $table->string('description', 200)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('status', 50)->index()->default('draft');
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
        Schema::dropIfExists('sbad_advertises');
    }
}
