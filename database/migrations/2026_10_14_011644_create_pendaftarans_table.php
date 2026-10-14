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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')
                ->constrained('pesertas')
                ->cascadeOnDelete();
            $table->foreignId('skema_sertifikasi_id')
                ->constrained('skema_sertifikasis')
                ->restrictOnDelete();
            $table->string('status')->default('Menunggu');
            $table->timestamps();

            $table->unique(['peserta_id', 'skema_sertifikasi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
