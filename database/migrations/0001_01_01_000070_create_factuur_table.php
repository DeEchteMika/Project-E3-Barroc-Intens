<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactuurTable extends Migration
{
    public function up()
    {
        Schema::create('factuur', function (Blueprint $table) {
            $table->increments('factuur_id');
            $table->string('factuurnummer', 100)->nullable();
            $table->unsignedInteger('klant_id')->nullable();
            $table->unsignedInteger('contract_id')->nullable();
            $table->date('datum')->nullable();
            $table->string('periode', 100)->nullable();
            $table->decimal('totaalbedrag', 12, 2)->nullable();
            $table->string('betalingsvoorwaarden', 255)->nullable();
            $table->text('opmerkingen')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factuur');
    }
}
