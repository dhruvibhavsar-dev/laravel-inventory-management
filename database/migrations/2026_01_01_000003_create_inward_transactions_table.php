<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inward_transactions', function (Blueprint $table) {
            $table->id(); // Internal inward/outward transaction ID, generated automatically.
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->foreignId('material_id')->constrained('materials')->restrictOnDelete();
            $table->date('transaction_date');
            $table->decimal('quantity', 12, 2); // Negative values represent outward movement.
            $table->timestamps();

            $table->index(['material_id', 'transaction_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inward_transactions');
    }
};
