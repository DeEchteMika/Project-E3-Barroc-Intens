<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnderhoudTable extends Migration
{
    public function up()
    {
        Schema::create('onderhoud', function (Blueprint $table) {
            $table->increments('onderhoud_id');
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('klant_id')->nullable();
            $table->unsignedInteger('monteur_id')->nullable();
            $table->dateTime('datum')->nullable();
            $table->boolean('checklist_voltooid')->default(false);
            $table->boolean('goedgekeurd')->default(false);
            $table->string('storingscode', 50)->nullable();
            $table->boolean('storing_verholpen')->default(false);
            $table->text('opmerkingen')->nullable();
            $table->string('handtekening_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('onderhoud');
    }
}
