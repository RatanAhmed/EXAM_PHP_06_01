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
            $table->string('uuid');
            $table->unsignedBigInteger('office_id');
            $table->string('colleague_name');
            $table->string('colleague_address');
            $table->string('colleague_mobile', 24);
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes();
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
