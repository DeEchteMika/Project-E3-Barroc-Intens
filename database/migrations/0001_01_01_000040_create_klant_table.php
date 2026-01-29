<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlantTable extends Migration
{
    public function up()
    {
        Schema::create('klant', function (Blueprint $table) {
            $table->increments('klant_id');
            $table->string('klantnummer', 50)->nullable();
            $table->string('bedrijfsnaam', 200)->nullable();
            $table->string('contactpersoon', 200)->nullable();
            $table->string('adres', 255)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->string('plaats', 100)->nullable();
            $table->string('telefoon', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->enum('bkr_check', ['Goed gekeurd!', 'Nog niet gekeurd...', 'Afgekeurd!'])->default('Nog niet gekeurd...');
            $table->unsignedInteger('onderhoud_interval_dagen')->nullable();
            $table->text('opmerkingen')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('klant');
    }
}
