<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rendez_vous_id')->constrained('rendez_vous')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->enum('statut', ['en_attente', 'paye', 'rembourse'])->default('en_attente');
            $table->string('reference')->unique();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('paiements');
        }
};
