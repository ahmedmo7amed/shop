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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name');
            $table->string('slug')->default('default-slug'.time());
            $table->boolean('status')->default(true); // Add the status column, defaulting to 'true'
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('color')->nullable(); // Category color
            $table->string('icon')->nullable(); // Icon for category
            $table->integer('order')->default(0); // Sorting order
            $table->boolean('is_active')->default(true);
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade'); // For nested categories
            $table->string('meta_title')->nullable(); // SEO title
            $table->text('meta_description')->nullable(); // SEO description
            $table->string('meta_keywords')->nullable(); // SEO keywords
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
