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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade'); // Relationship with Brand
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relationship with Category                
            $table->string('name');
            $table->boolean('is_trendy')->default(false);
            $table->boolean('is_available')->default(true);
            $table->string('slug')->unique(); // Unique slug for the product
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Price with 2 decimal places
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->string('image')->nullable(); // Image URL
            $table->integer('quantity')->default(0); // Stock quantity
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
