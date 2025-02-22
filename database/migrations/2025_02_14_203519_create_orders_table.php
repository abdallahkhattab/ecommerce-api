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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('location_id')->constrained()->onDelete('cascade')->nullable(); // Foreign key to locations table
            $table->string('order_number')->unique(); // Unique order number
            $table->decimal('total_price', 12, 2); // Total price of the order
            $table->date('date_of_delivery')->nullable(); // Date of delivery (optional)
            $table->enum('status', ['pending','processing','paid','shipped','delivered','canceled'])->default('Pending'); // Order status
            $table->timestamps(); // Created_at and updated_at timestamps
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
