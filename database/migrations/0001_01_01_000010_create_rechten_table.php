<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechtenTable extends Migration
{
    public function up()
    {
        Schema::create('rechten', function (Blueprint $table) {
            $table->increments('rechten_id');
            $table->string('rol', 50);
            $table->tinyInteger('toegangsniveau')->default(1);
            $table->text('beschrijving')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rechten');
    }
}
