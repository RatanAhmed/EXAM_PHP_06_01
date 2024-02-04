<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyColleaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_colleagues', function (Blueprint $table) {
            $table->id();
            $table->string('office_name');
            $table->string('office_address');
            $table->string('office_phone');
            $table->string('appointment_letter');
            $table->string('colleague_name');
            $table->string('colleague_address');
            $table->string('colleague_mobile');
            $table->string('appointment_letter');
            $table->string('photo');
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
        Schema::dropIfExists('my_colleagues');
    }
}
