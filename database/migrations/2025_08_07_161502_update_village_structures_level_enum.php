<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, change the column to string temporarily
        Schema::table('kua_structures', function (Blueprint $table) {
            $table->string('level')->change();
        });

        // Update existing data to new structure
        DB::table('kua_structures')->where('level', 'kepala_desa')->update(['level' => 'kepala_kemenag']);
        DB::table('kua_structures')->where('level', 'sekretaris')->update(['level' => 'kesubagg_tu']);
        DB::table('kua_structures')->where('level', 'kaur')->update(['level' => 'kasi_bimas_islam']);
        DB::table('kua_structures')->where('level', 'kasi')->update(['level' => 'kepala_kua']);
        DB::table('kua_structures')->where('level', 'kadus')->update(['level' => 'pengadministrasi']);
        DB::table('kua_structures')->where('level', 'bpd')->update(['level' => 'operator_simkah']);

        // Now change back to enum with new values
        Schema::table('kua_structures', function (Blueprint $table) {
            $table->enum('level', ['kepala_kemenag', 'kesubagg_tu', 'kasi_bimas_islam', 'kepala_kua', 'pengadministrasi', 'operator_simkah', 'pramu_kantor'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, change the column to string temporarily
        Schema::table('village_structures', function (Blueprint $table) {
            $table->string('level')->change();
        });

        // Revert data back to old structure
        DB::table('kua_structures')->where('level', 'kepala_kemenag')->update(['level' => 'kepala_desa']);
        DB::table('kua_structures')->where('level', 'kesubagg_tu')->update(['level' => 'sekretaris']);
        DB::table('kua_structures')->where('level', 'kasi_bimas_islam')->update(['level' => 'kaur']);
        DB::table('kua_structures')->where('level', 'kepala_kua')->update(['level' => 'kasi']);
        DB::table('kua_structures')->where('level', 'pengadministrasi')->update(['level' => 'kadus']);
        DB::table('kua_structures')->where('level', 'operator_simkah')->update(['level' => 'bpd']);

        // Revert enum back to old values
        Schema::table('kua_structures', function (Blueprint $table) {
            $table->enum('level', ['kepala_desa', 'sekretaris', 'kaur', 'kasi', 'kadus', 'bpd'])->change();
        });
    }
};
