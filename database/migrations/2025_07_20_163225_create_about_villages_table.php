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
        Schema::create('about_villages', function (Blueprint $table) {
            $table->id();
            $table->integer('people_total')->nullable();
            $table->integer('family_total')->nullable();
            $table->integer('blok_total')->nullable();
            $table->integer('program_total')->nullable();
            $table->text('description')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('location')->nullable();
            $table->text('no_telp')->nullable();
            $table->text('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_villages');
    }
};
