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
        Schema::create('predio_solicituds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('predio_id')->constrained()->onDelete('cascade');
            $table->foreignId('solicitud_id')->constrained()->onDelete('cascade');
            $table->foreignId('entregado_por')->nullable()->references('id')->on('users');
            $table->timestamp('entregado_en')->nullable();
            $table->foreignId('recibido_por')->nullable()->references('id')->on('users');
            $table->timestamp('recibido_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predio_solicituds');
    }
};
