<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedewerkerTable extends Migration
{
    public function up()
    {
        Schema::create('medewerker', function (Blueprint $table) {
            $table->increments('medewerker_id');
            $table->string('voornaam', 100);
            $table->string('achternaam', 100);
            $table->string('functie', 100)->nullable();
            $table->unsignedInteger('afdeling_id')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('telefoon', 50)->nullable();
            $table->unsignedInteger('rechten_id')->nullable();
            $table->boolean('actief')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medewerker');
    }
}
