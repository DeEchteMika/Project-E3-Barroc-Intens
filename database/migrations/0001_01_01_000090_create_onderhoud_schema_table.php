<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnderhoudSchemaTable extends Migration
{
    public function up()
    {
        Schema::create('onderhoud_schema', function (Blueprint $table) {
            $table->increments('onderhoud_schema_id');
            $table->unsignedInteger('contract_id');
            $table->unsignedInteger('klant_id');
            $table->unsignedInteger('interval_dagen'); // 30, 180, 365 dagen
            $table->string('interval_label', 50); // '1 maand', '6 maanden', '1 jaar'
            $table->dateTime('volgende_onderhoud'); // volgende geplande onderhouddatum
            $table->dateTime('laatste_onderhoud')->nullable(); // datum van laatste onderhoud
            $table->boolean('actief')->default(true);
            $table->text('opmerkingen')->nullable();
            $table->timestamps();

            $table->foreign('contract_id')->references('contract_id')->on('contract')->onDelete('cascade');
            $table->foreign('klant_id')->references('klant_id')->on('klant')->onDelete('cascade');
            $table->index('volgende_onderhoud');
            $table->index('klant_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('onderhoud_schema');
    }
}
