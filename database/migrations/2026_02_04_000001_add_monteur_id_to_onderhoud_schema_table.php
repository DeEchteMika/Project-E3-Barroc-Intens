<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonteurIdToOnderhoudSchemaTable extends Migration
{
    public function up()
    {
        Schema::table('onderhoud_schema', function (Blueprint $table) {
            $table->unsignedInteger('monteur_id')->nullable()->after('klant_id');
            $table->foreign('monteur_id')->references('medewerker_id')->on('medewerker')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('onderhoud_schema', function (Blueprint $table) {
            $table->dropForeign(['monteur_id']);
            $table->dropColumn('monteur_id');
        });
    }
}
