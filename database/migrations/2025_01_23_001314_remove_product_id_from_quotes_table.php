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
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign('quotes_product_id_foreign'); // Use the actual constraint name

            $table->dropColumn(['product_id', 'quantity', 'unit_price']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            // Recreate the foreign key constraint if needed
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }
};
