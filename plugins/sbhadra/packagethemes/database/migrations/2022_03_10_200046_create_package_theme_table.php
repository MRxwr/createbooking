<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_themes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->string('slug', 250)->unique()->index();
            $table->longText('description', 300)->nullable();
            $table->string('thumbnail', 250)->nullable();
            $table->string('status', 50)->default('no');
            $table->timestamps();
        });
        Schema::table('bookings', function($table) {
            $table->integer('theme_id')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_themes');
        
    }
}
