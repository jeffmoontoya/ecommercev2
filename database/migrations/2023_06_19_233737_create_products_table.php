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
            $table->unsignedBigInteger('category_id'); // <-- This is a foreign key
            $table->string('product_image')->nullable();
            $table->string('product_name', 100);
            $table->text('product_description');
            $table->decimal('product_price', 12, 2);
            $table->integer('product_stock');
            $table->softDeletes();
            $table->timestamps();

            // This is the foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // <-- This is a foreign key
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
