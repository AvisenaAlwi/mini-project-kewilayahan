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
        Schema::create('baes1s', function (Blueprint $table) {
            $table->string('id', 5)->primary();
            $table->string('ba_id',3);
            $table->foreign('ba_id')->references('id')->on('bas')->onUpdate('cascade')->onDelete('restrict');
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baes1s');
    }
};
