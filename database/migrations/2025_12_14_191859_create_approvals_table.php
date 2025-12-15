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
    Schema::create('approvals', function (Blueprint $table) {
        $table->id('ApprovalID');
        $table->foreignId('RequestID')->constrained('lending_requests', 'RequestID')->onDelete('cascade');
        $table->foreignId('ApproverID')->constrained('users')->onDelete('cascade');
        $table->date('ApprovalDate')->default(now());
        $table->string('Decision'); // Approved, Declined
        $table->text('Remarks')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
