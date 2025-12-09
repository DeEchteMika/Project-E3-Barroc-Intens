<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('storing', function (Blueprint $table) {
            $table->id('storing_id');
            $table->string('naam');
            $table->text('beschrijving')->nullable();
            $table->enum('status', ['open', 'in behandeling', 'opgelost'])->default('open');
            $table->string('locatie')->nullable();
            $table->string('bedrijf')->nullable();
            $table->dateTime('datum')->nullable();
            $table->unsignedInteger('klant_id')->nullable();
            $table->unsignedInteger('monteur_id')->nullable();
            $table->timestamps();
            // Foreign keys
            $table->foreign('klant_id')->references('klant_id')->on('klant')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('monteur_id')->references('medewerker_id')->on('medewerker')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storing');
    }
};
