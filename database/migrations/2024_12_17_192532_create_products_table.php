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
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('sku')->unique();
        $table->string('barcode')->nullable();
        $table->boolean('status')->nullable();
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);
        $table->decimal('discount_price', 10, 2)->nullable();
        $table->decimal('cost', 10, 2)->nullable();
        $table->string('brand')->nullable();
        $table->decimal('weight', 8, 2)->nullable();
        $table->string('dimensions')->nullable();
        $table->json('tags')->nullable();
        $table->unsignedBigInteger('views_count')->default(0);
        $table->boolean('is_hot')->default(false);
        $table->boolean('featured')->default(false);
        $table->integer('rating')->default(5);
        $table->integer('stock')->default(0);
        $table->boolean('is_active')->default(true);
        $table->foreignId('category_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null');
        $table->date('expires_at')->nullable();
        $table->string('images')->nullable();
        $table->string('stock_status')->nullable();  // New field
        $table->timestamps();
        $table->softDeletes();
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
