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
        Schema::create('analysis_metas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analysis_id')->constrained('analysis'); // analysis_id: integer, foreign key to analysis
            $table->foreignId('category_id')->constrained('categories'); // category_id: integer, foreign key to categories
            $table->foreignId('upload_id')->constrained('uploads'); // upload_id: integer, foreign key to uploads
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysis_metas');
    }
};
