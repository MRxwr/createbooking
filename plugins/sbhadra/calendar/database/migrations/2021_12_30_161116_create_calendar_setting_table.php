<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->json('close_days')->nullable();
            $table->string('status', 50)->default('yes');
            $table->timestamps();
        });
        // Insert some stuff
        // DB::table('calendar_settings')->insert(
        //     array(
        //         'start_date' => '2021-12-24',
        //         'end_date' => '2021-12-30',
        //         'close_days' => '[1,2,4]',
        //         'status' => 'yes',
        //     )
        //   );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_settings');
    }
}
