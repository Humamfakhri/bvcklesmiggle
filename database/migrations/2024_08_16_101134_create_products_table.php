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
            $table->string('category');
            $table->string('name');
            $table->string('link_shopee');
            // $table->boolean('is_active_shopee');
            $table->string('link_tokopedia');
            // $table->boolean('is_active_tokopedia');
            $table->json('product_images'); // Menyimpan beberapa product images dalam format JSON
            $table->text('issue'); // Menyimpan detail image
            $table->text('details'); // Menyimpan detail image
            // $table->foreign('category')->references('id')->on('product_categories');
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
