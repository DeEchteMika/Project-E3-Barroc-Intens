<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactuurregelTable extends Migration
{
    public function up()
    {
        Schema::create('factuurregel', function (Blueprint $table) {
            $table->increments('factuurregel_id');
            $table->unsignedInteger('factuur_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->string('omschrijving', 255)->nullable();
            $table->integer('aantal')->default(1);
            $table->decimal('prijs_per_stuk', 10, 2)->nullable();
            $table->decimal('subtotaal', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factuurregel');
    }
}
