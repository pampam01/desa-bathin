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
        Schema::create('mail_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('nik');
            $table->bigInteger('no_kk');
            $table->string('name');
            $table->enum('jenis_surat', [
                'surat pelayanan haji',
                'surat rujuk',
                'surat rekomendasi nikah',
                'surat pengaduan gugat cerai',
                'surat rekomendasi tanah wakaf',
            ]);
            $table->text('description')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status', ['pending', 'process', 'completed', 'rejected'])->default('pending');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_submissions');
    }
};
