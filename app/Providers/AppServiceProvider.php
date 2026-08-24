<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Auto-ensure columns in live database without requiring manual migration
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('game_accounts')) {
                \Illuminate\Support\Facades\Schema::table('game_accounts', function (\Illuminate\Database\Schema\Blueprint $table) {
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('game_accounts', 'product_type')) {
                        $table->string('product_type')->default('game_account')->nullable();
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('game_accounts', 'stock_qty')) {
                        $table->integer('stock_qty')->default(1)->nullable();
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('game_accounts', 'duration_value')) {
                        $table->integer('duration_value')->nullable();
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('game_accounts', 'duration_unit')) {
                        $table->string('duration_unit')->nullable();
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('game_accounts', 'account_variant')) {
                        $table->string('account_variant')->nullable();
                    }
                });
            }
        } catch (\Throwable $e) {
            // Silently continue if database is currently inaccessible
        }
    }
}
