<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->longText('note', 1000)->nullable();
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('package_types_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 250);
            $table->decimal('price', 10,2)->default('0.00');
            $table->integer('package_type_id');
            $table->integer('is_theme')->default('0');
            $table->string('status');
            $table->timestamps();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->longText('package_type_attributes', 1000)->nullable();
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->longText('package_type_attribute', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_types');
        Schema::dropIfExists('package_types_attribute');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('bookings');
    }
}
