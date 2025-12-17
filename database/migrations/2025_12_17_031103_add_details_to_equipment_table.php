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
    Schema::table('equipment', function (Blueprint $table) {
        $table->string('Category')->nullable()->after('Name'); // e.g., IT, Lab, Audio
        $table->integer('Quantity')->default(1)->after('Category');
        $table->string('Condition')->default('Good')->after('Quantity'); // New, Good, Fair, Damaged
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment', function (Blueprint $table) {
            //
        });
    }
};
