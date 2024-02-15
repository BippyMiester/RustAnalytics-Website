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
        Schema::create('battlemetrics_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('battlemetrics_id');
            $table->unsignedBigInteger('steam_id');
            $table->string('profile_status');
            $table->string('username');
            $table->text('profile_url');
            $table->text('steam_avatar');
            $table->boolean('vac_banned');
            $table->unsignedBigInteger('vac_ban_count');
            $table->boolean('community_banned');
            $table->unsignedBigInteger('days_since_last_ban');
            $table->unsignedBigInteger('game_bans_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battlemetrics_players');
    }
};
