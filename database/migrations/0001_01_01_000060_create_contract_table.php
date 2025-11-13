<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->increments('contract_id');
            $table->unsignedInteger('klant_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->string('contractnummer', 100)->nullable();
            $table->date('startdatum')->nullable();
            $table->date('einddatum')->nullable();
            $table->decimal('maandbedrag', 10, 2)->nullable();
            $table->text('opmerkingen')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contract');
    }
}
