<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('productnummer', 50)->nullable();
            $table->string('naam', 200);
            $table->text('omschrijving')->nullable();
            $table->decimal('prijs', 10, 2)->nullable();
            $table->integer('voorraad')->default(0);
            $table->boolean('heeft_maler')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product');
    }
}
