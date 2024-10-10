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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('path'); // path: string, required
            $table->string('name'); // name: string, required
            $table->string('extension'); // extension: string, required
            $table->double('size'); // size: double, required
            $table->foreignId('brand_id')->constrained('brands'); // brand_id: integer, foreign key to brands
            $table->foreignId('category_id')->constrained('categories'); // category_id: integer, foreign key to categories
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
