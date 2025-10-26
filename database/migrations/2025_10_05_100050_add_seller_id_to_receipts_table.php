<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            // Only add if it doesn't exist yet
            if (!Schema::hasColumn('receipts', 'seller_id')) {
                $table->unsignedBigInteger('seller_id')->nullable()->after('product_id');
            }

            // Add foreign key constraint
            $table->foreign('seller_id')
                  ->references('id')
                  ->on('sellers')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            if (Schema::hasColumn('receipts', 'seller_id')) {
                $table->dropForeign(['seller_id']);
                $table->dropColumn('seller_id');
            }
        });
    }
};
