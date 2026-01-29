<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnderhoudIntervalDagenToKlantTable extends Migration
{
    public function up()
    {
        Schema::table('klant', function (Blueprint $table) {
            if (!Schema::hasColumn('klant', 'onderhoud_interval_dagen')) {
                $table->unsignedInteger('onderhoud_interval_dagen')->nullable()->after('bkr_check');
            }
        });
    }

    public function down()
    {
        Schema::table('klant', function (Blueprint $table) {
            $table->dropColumn('onderhoud_interval_dagen');
        });
    }
}
