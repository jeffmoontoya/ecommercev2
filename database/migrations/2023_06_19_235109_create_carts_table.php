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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // <-- This is a foreign key
            $table->unsignedBigInteger('user_id'); // <-- This is a foreign key
            $table->integer('quantity');
            $table->decimal('total_price', 12, 2);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // <-- This is a foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // <-- This is a foreign key
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
