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
        if (!Schema::hasColumn('users', 'is_banned')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_banned')->default(false)->after('role');
                $table->string('ban_reason')->nullable()->after('is_banned');
            });
        }

        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                $table->string('user_name')->nullable();
                $table->string('user_role')->nullable();
                $table->string('action'); // e.g. LOGIN, CREATE_ACCOUNT, UPDATE_ACCOUNT, DELETE_ACCOUNT, CHANGE_ROLE, BAN_USER, UPDATE_SETTINGS
                $table->text('description');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->json('properties')->nullable();
                $table->timestamps();

                $table->index(['created_at', 'action']);
                $table->index('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        if (Schema::hasColumn('users', 'is_banned')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['is_banned', 'ban_reason']);
            });
        }
    }
};

