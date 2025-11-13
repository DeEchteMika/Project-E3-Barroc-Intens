<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerichtTable extends Migration
{
    public function up()
    {
        Schema::create('bericht', function (Blueprint $table) {
            $table->increments('bericht_id');
            $table->unsignedInteger('verzender_id')->nullable();
            $table->unsignedInteger('ontvanger_id')->nullable();
            $table->string('onderwerp', 255)->nullable();
            $table->text('inhoud')->nullable();
            $table->dateTime('datum')->useCurrent();
            $table->boolean('gelezen')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bericht');
    }
}
