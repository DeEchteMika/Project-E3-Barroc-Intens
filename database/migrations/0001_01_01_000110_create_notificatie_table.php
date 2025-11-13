<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificatieTable extends Migration
{
    public function up()
    {
        Schema::create('notificatie', function (Blueprint $table) {
            $table->increments('notificatie_id');
            $table->unsignedInteger('medewerker_id');
            $table->string('type', 100)->nullable();
            $table->string('bericht_tekst', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->boolean('gelezen')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notificatie');
    }
}
