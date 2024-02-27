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
        Schema::create('ros', function (Blueprint $table) {
            $table->string('id', 3);
            $table->string('kro_id',3);
            $table->foreign('kro_id')->references('id')->on('kros')->onUpdate('cascade')->onDelete('restrict');
            $table->string('uraian');
            $table->timestamps();
            $table->primary(['id', 'kro_id', 'uraian']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ros');
    }
};
