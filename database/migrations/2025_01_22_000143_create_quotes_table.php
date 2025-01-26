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
        Schema::create('quotes', function (Blueprint $table) {
                    $table->id();
                    $table->string('company_name');
                    $table->string('contact_name');
                    $table->string('email');
                    $table->string('phone');
                    $table->text('address');
                    $table->string('tax_number')->nullable();
                    $table->date('expiration_date');
                    $table->text('special_notes')->nullable();
                    $table->decimal('subtotal', 10, 2);
                    $table->decimal('tax_total', 10, 2);
                    $table->decimal('grand_total', 10, 2);
                    $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
