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
        Schema::create('data', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('provinsi_id', 2);
            $table->string('kabupaten_kota_id', 4);
            $table->string('kanwil_id');
            $table->string('kppn_id');
            $table->string('ba_id');
            $table->string('baes1_id');
            $table->string('satker_id');
            $table->string('program_id');
            $table->string('kegiatan_id');
            $table->string('kro_id');
            $table->string('ro_id');
            $table->unsignedTinyInteger('revision')->default(0);
            $table->double('pagu')->default(0);
            $table->double('realisasi')->default(0);
            $table->double('persen_realisasi')->default(0.0);
            $table->double('target')->default(0);
            $table->double('real_ro_bulan_ini')->nullable();
            $table->double('progress_ro_bulan_ini')->default(0.0);
            $table->double('real_ro_bulan_akm')->nullable();
            $table->double('progress_ro_bulan_akm')->default(0.0);
            $table->double('gap')->default(0.0);
            $table->foreign('provinsi_id', 2)->references('id')->on('provinsis')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kabupaten_kota_id', 4)->references('id')->on('kabupaten_kotas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kanwil_id')->references('id')->on('kanwils')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kppn_id')->references('id')->on('kppns')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('ba_id')->references('id')->on('bas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('baes1_id')->references('id')->on('baes1s')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('satker_id')->references('id')->on('satkers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('program_id')->references('id')->on('programs')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kro_id')->references('id')->on('kros')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('ro_id')->references('id')->on('ros')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
