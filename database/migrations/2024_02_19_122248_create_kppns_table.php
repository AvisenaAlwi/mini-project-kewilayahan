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
        Schema::create('kppns', function (Blueprint $table) {
            $table->string('id', 3)->primary();
            $table->string('kanwil_id',3);
            $table->foreign('kanwil_id')->references('id')->on('kanwils')->onUpdate('cascade')->onDelete('restrict');
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kppns');
    }
};
