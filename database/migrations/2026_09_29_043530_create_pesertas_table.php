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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('no_peserta',50)->unique();
            $table->string('nama');
            $table->string('nik', 20)->unique();
            $table->string('email')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->text('alamat')->nullable();

            $table->foreignId('skema_sertifikasi_id')
                ->constrained('skema_sertifikasis')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
