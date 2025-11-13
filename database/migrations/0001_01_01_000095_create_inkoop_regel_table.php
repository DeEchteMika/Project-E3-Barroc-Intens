<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInkoopRegelTable extends Migration
{
    public function up()
    {
        Schema::create('inkoop_regel', function (Blueprint $table) {
            $table->increments('inkoopregel_id');
            $table->unsignedInteger('inkoop_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->integer('aantal')->default(1);
            $table->decimal('prijs_per_stuk', 10, 2)->nullable();
            $table->decimal('subtotaal', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inkoop_regel');
    }
}
