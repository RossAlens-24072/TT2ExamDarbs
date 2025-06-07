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
        Schema::create('bilde', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignId('ieraksti_id')->nullable()->constrained('ieraksti')->onDelete('cascade');
            $table->foreignId('komentari_id')->nullable()->constrained('komentari')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bildes');
    }
};
