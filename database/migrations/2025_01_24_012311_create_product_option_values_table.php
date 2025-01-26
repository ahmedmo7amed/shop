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
        Schema::create('product_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_id')->constrained()->onDelete('cascade');
            $table->string('value'); // القيمة (مثل: سعة 5 لتر)
            $table->decimal('price', 8, 2); // السعر الخاص بهذه السعة
            $table->decimal('length', 8, 2); // الطول
            $table->decimal('diameter', 8, 2); // القطر
            $table->decimal('height', 8, 2); // الارتفاع
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option_values');
    }
};
