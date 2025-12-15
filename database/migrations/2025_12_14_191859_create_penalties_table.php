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
    Schema::create('penalties', function (Blueprint $table) {
        $table->id('PenaltyID');
        $table->foreignId('RequestID')->constrained('lending_requests', 'RequestID')->onDelete('cascade');
        $table->decimal('Amount', 8, 2);
        $table->string('Reason');
        $table->date('DateIssued')->default(now());
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
