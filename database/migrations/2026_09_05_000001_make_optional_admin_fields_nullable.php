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
        Schema::table('products', function (Blueprint $table) {
            $table->string('link_shopee')->nullable()->change();
            $table->string('link_tokopedia')->nullable()->change();
        });

        Schema::table('partnerships', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->text('link')->nullable()->change();
        });

        Schema::table('downloads', function (Blueprint $table) {
            $table->string('link')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('link_shopee')->nullable(false)->change();
            $table->string('link_tokopedia')->nullable(false)->change();
        });

        Schema::table('partnerships', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change();
            $table->text('link')->nullable(false)->change();
        });

        Schema::table('downloads', function (Blueprint $table) {
            $table->string('link')->nullable(false)->change();
        });
    }
};
