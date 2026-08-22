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
        Schema::create('game_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_category_id')->constrained('game_categories')->onDelete('cascade');
            $table->string('code')->unique(); // e.g. AZS-ML-001
            $table->string('title');
            $table->string('slug')->unique();
            $table->decimal('price', 15, 2);
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->string('login_bind'); // e.g. "Moonton Sepaket / All Unbind", "Google Play", "Facebook", "Twitter", "Clean Bind"
            $table->string('server')->default('Indonesia'); // e.g. Indonesia, Asia, Global
            $table->enum('status', ['available', 'sold', 'booked'])->default('available');
            $table->string('thumbnail')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('full_specs')->nullable();
            $table->integer('hero_count')->nullable();
            $table->integer('skin_count')->nullable();
            $table->string('rank_tier')->nullable(); // e.g. Mythical Glory, Heroic, etc.
            $table->string('winrate')->nullable(); // e.g. 68.5%
            $table->boolean('is_verified')->default(true); // Garansi Anti-Hackback
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_accounts');
    }
};
