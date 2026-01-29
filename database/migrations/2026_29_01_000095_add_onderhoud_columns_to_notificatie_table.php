<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnderhoudColumnsToNotificatieTable extends Migration
{
    public function up()
    {
        Schema::table('notificatie', function (Blueprint $table) {
            // Check if columns don't already exist before adding
            if (!Schema::hasColumn('notificatie', 'onderhoud_schema_id')) {
                $table->unsignedInteger('onderhoud_schema_id')->nullable()->after('medewerker_id');
            }
            if (!Schema::hasColumn('notificatie', 'klant_id')) {
                $table->unsignedInteger('klant_id')->nullable()->after('onderhoud_schema_id');
            }
        });
    }

    public function down()
    {
        Schema::table('notificatie', function (Blueprint $table) {
            $table->dropColumn(['onderhoud_schema_id', 'klant_id']);
        });
    }
}
