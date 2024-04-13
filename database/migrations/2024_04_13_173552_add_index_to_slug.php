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
        Schema::table('stores', function (Blueprint $table) {
            $table->index('slug');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->index('slug');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropIndex(['slug']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['slug']);
        });
        Schema::table('products', function (Blueprint $table) {
            // Drop the index if you ever need to rollback the migration
            $table->dropIndex(['slug']);
        });
    }
};
