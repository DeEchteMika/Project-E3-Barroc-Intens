<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    public function up()
    {
        // rechten -> medewerker
        Schema::table('medewerker', function (Blueprint $table) {
            $table->foreign('rechten_id')->references('rechten_id')->on('rechten')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('afdeling_id')->references('afdeling_id')->on('afdeling')->onDelete('set null')->onUpdate('cascade');
        });

        // afdeling.hoofd_id -> medewerker (circular reference, added after medewerker exists)
        Schema::table('afdeling', function (Blueprint $table) {
            $table->foreign('hoofd_id')->references('medewerker_id')->on('medewerker')->onDelete('set null')->onUpdate('cascade');
        });

        // contract -> klant, product
        Schema::table('contract', function (Blueprint $table) {
            $table->foreign('klant_id')->references('klant_id')->on('klant')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('set null')->onUpdate('cascade');
        });

        // factuur -> klant, contract
        Schema::table('factuur', function (Blueprint $table) {
            $table->foreign('klant_id')->references('klant_id')->on('klant')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('contract_id')->references('contract_id')->on('contract')->onDelete('set null')->onUpdate('cascade');
        });

        // factuurregel -> factuur, product
        Schema::table('factuurregel', function (Blueprint $table) {
            $table->foreign('factuur_id')->references('factuur_id')->on('factuur')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('set null')->onUpdate('cascade');
        });

        // onderhoud -> contract, klant, monteur(medewerker)
        Schema::table('onderhoud', function (Blueprint $table) {
            $table->foreign('contract_id')->references('contract_id')->on('contract')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('klant_id')->references('klant_id')->on('klant')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('monteur_id')->references('medewerker_id')->on('medewerker')->onDelete('set null')->onUpdate('cascade');
        });

        // onderhoud_onderdelen -> onderhoud, product (restrict on delete as in markup)
        Schema::table('onderhoud_onderdelen', function (Blueprint $table) {
            $table->foreign('onderhoud_id')->references('onderhoud_id')->on('onderhoud')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('restrict')->onUpdate('cascade');
        });

        // inkoop -> medewerker
        Schema::table('inkoop', function (Blueprint $table) {
            $table->foreign('medewerker_id')->references('medewerker_id')->on('medewerker')->onDelete('set null')->onUpdate('cascade');
        });

        // inkoop_regel -> inkoop, product
        Schema::table('inkoop_regel', function (Blueprint $table) {
            $table->foreign('inkoop_id')->references('inkoop_id')->on('inkoop')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('restrict')->onUpdate('cascade');
        });

        // bericht -> medewerker (verzender, ontvanger)
        Schema::table('bericht', function (Blueprint $table) {
            $table->foreign('verzender_id')->references('medewerker_id')->on('medewerker')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('ontvanger_id')->references('medewerker_id')->on('medewerker')->onDelete('set null')->onUpdate('cascade');
        });

        // notificatie -> medewerker (on delete cascade as in markup)
        Schema::table('notificatie', function (Blueprint $table) {
            $table->foreign('medewerker_id')->references('medewerker_id')->on('medewerker')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        // Drop constraints (best-effort)
        Schema::table('medewerker', function (Blueprint $table) {
            $table->dropForeign(['rechten_id']);
            $table->dropForeign(['afdeling_id']);
        });

        Schema::table('afdeling', function (Blueprint $table) {
            $table->dropForeign(['hoofd_id']);
        });

        Schema::table('contract', function (Blueprint $table) {
            $table->dropForeign(['klant_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('factuur', function (Blueprint $table) {
            $table->dropForeign(['klant_id']);
            $table->dropForeign(['contract_id']);
        });

        Schema::table('factuurregel', function (Blueprint $table) {
            $table->dropForeign(['factuur_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('onderhoud', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
            $table->dropForeign(['klant_id']);
            $table->dropForeign(['monteur_id']);
        });

        Schema::table('onderhoud_onderdelen', function (Blueprint $table) {
            $table->dropForeign(['onderhoud_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('inkoop', function (Blueprint $table) {
            $table->dropForeign(['medewerker_id']);
        });

        Schema::table('inkoop_regel', function (Blueprint $table) {
            $table->dropForeign(['inkoop_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('bericht', function (Blueprint $table) {
            $table->dropForeign(['verzender_id']);
            $table->dropForeign(['ontvanger_id']);
        });

        Schema::table('notificatie', function (Blueprint $table) {
            $table->dropForeign(['medewerker_id']);
        });
    }
}
