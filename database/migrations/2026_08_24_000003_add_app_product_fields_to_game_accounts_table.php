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
        Schema::table('game_accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('game_accounts', 'product_type')) {
                $table->string('product_type')->default('game_account')->after('game_category_id');
            }
            if (!Schema::hasColumn('game_accounts', 'stock_qty')) {
                $table->integer('stock_qty')->default(1)->after('status');
            }
            if (!Schema::hasColumn('game_accounts', 'duration_value')) {
                $table->integer('duration_value')->nullable()->after('stock_qty');
            }
            if (!Schema::hasColumn('game_accounts', 'duration_unit')) {
                $table->string('duration_unit')->nullable()->after('duration_value');
            }
            if (!Schema::hasColumn('game_accounts', 'account_variant')) {
                $table->string('account_variant')->nullable()->after('duration_unit');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_accounts', function (Blueprint $table) {
            $table->dropColumn(['product_type', 'stock_qty', 'duration_value', 'duration_unit', 'account_variant']);
        });
    }
};
