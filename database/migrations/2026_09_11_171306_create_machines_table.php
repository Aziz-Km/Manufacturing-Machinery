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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factory_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable(); // e.g., generator, compressor
            $table->string('serial_number')->nullable();
            $table->string('status')->default('active'); // active, maintenance, inactive
            $table->integer('total_operating_hours')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
