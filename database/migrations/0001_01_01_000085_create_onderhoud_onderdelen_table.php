<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnderhoudOnderdelenTable extends Migration
{
    public function up()
    {
        Schema::create('onderhoud_onderdelen', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('onderhoud_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->integer('aantal')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('onderhoud_onderdelen');
    }
}
