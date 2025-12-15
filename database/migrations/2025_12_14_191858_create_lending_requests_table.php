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
    Schema::create('lending_requests', function (Blueprint $table) {
        $table->id('RequestID');
        $table->foreignId('BorrowerID')->constrained('users')->onDelete('cascade');
        $table->foreignId('EquipmentID')->constrained('equipment', 'EquipmentID')->onDelete('cascade');
        $table->string('Purpose');
        $table->date('RequestDate')->default(now());
        $table->date('DesiredReturnDate');
        $table->string('Status')->default('Pending'); // Pending, Approved, Declined
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lending_requests');
    }
};
