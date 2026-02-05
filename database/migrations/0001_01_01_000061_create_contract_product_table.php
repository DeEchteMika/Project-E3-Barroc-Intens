<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractProductTable extends Migration
{
    public function up()
    {
        Schema::create('contract_product', function (Blueprint $table) {
            $table->unsignedInteger('contract_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('aantal')->default(1);
            $table->timestamps();

            $table->primary(['contract_id', 'product_id']);
            $table->foreign('contract_id')->references('contract_id')->on('contract')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contract_product');
    }
}
