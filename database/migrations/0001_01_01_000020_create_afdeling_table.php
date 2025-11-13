<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfdelingTable extends Migration
{
    public function up()
    {
        Schema::create('afdeling', function (Blueprint $table) {
            $table->increments('afdeling_id');
            $table->string('naam', 100);
            $table->unsignedInteger('hoofd_id')->nullable();
            $table->text('beschrijving')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('afdeling');
    }
}
