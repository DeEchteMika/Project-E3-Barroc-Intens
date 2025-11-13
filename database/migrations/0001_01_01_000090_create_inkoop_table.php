<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInkoopTable extends Migration
{
    public function up()
    {
        Schema::create('inkoop', function (Blueprint $table) {
            $table->increments('inkoop_id');
            $table->unsignedInteger('medewerker_id')->nullable();
            $table->dateTime('datum')->nullable();
            $table->decimal('totaalbedrag', 12, 2)->nullable();
            $table->text('opmerking')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inkoop');
    }
}
