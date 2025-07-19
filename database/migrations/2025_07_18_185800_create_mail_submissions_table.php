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
            $table->integer('nik');
            $table->integer('no_kk');
            $table->string('name');
            $table->enum('jenis_surat', [
                'Surat Keterangan Domisili',
                'Surat Keterangan Usaha',
                'Surat Keterangan Tidak Mampu',
                'Surat Keterangan Kematian',
                'Surat Keterangan Lahir',
                'Surat Keterangan Pindah',
                'Surat Keterangan Belum Menikah',
                'Surat Keterangan Cerai',
            ]);
            $table->text('description')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status', ['pending', 'process', 'completed'])->default('pending');
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
