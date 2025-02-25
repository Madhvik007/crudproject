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
        Schema::rename('products', 'posts');

        // Modify columns to fit blog structure
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('title', 'title'); // Keep title
            $table->text('content')->nullable(); // Add content field
            $table->renameColumn('category', 'category'); // Keep category
            $table->dropColumn('price'); // Remove price (not needed for blog)
            $table->unsignedBigInteger('author_id')->after('category'); // Add author ID
            $table->timestamp('published_at')->nullable(); // Add publish date

            // Define foreign key
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['content', 'author_id', 'published_at']);
            $table->integer('price')->nullable(); // Restore price
        });

        // Rename back to 'products' if needed
        Schema::rename('posts', 'products');
    }
};
