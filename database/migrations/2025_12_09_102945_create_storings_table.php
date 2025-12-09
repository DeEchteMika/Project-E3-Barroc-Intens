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
            $table->unsignedBigInteger('klant_id')->nullable();
            $table->unsignedBigInteger('monteur')->nullable();
            $table->timestamps();
            // Foreign keys
            $table->foreign('klant_id')->references('klant_id')->on('klant')->onDelete('set null');
            $table->foreign('medewerker_id')->references('id')->on('users')->onDelete('set null');
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
