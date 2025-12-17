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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id('EquipmentID'); // Primary Key
            $table->string('Name');
            
            // --- NEW COLUMNS (Fixes the "Unknown Column" error) ---
            $table->string('Category')->nullable(); 
            $table->integer('Quantity')->default(1);
            $table->string('Condition')->default('Good');
            // -----------------------------------------------------

            $table->text('Description')->nullable();
            $table->string('AvailabilityStatus')->default('Available'); // Available, Borrowed, Maintenance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};