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
        Schema::create('village_structures', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pejabat
            $table->string('position'); // Jabatan (Kepala Desa, Sekretaris, etc.)
            $table->enum('level', ['kepala_desa', 'sekretaris', 'kaur', 'kasi', 'kadus', 'bpd']); // Level hierarki
            $table->string('department')->nullable(); // Bagian/departemen (TU, Keuangan, etc.)
            $table->string('photo')->nullable(); // Path foto
            $table->text('description')->nullable(); // Deskripsi singkat
            $table->string('phone')->nullable(); // Nomor telepon
            $table->string('email')->nullable(); // Email
            $table->integer('sort_order')->default(0); // Urutan tampil
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_structures');
    }
};
