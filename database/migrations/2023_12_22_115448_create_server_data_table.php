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
        Schema::create('server_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('server_id');
            $table->unsignedBigInteger('entities');
            $table->unsignedBigInteger('players_online');
            $table->unsignedBigInteger('players_max');
            $table->string('in_game_time');
            $table->unsignedBigInteger('server_fps');
            $table->unsignedFloat('used_memory');
            $table->unsignedFloat('max_memory');
            $table->unsignedFloat('network_in');
            $table->unsignedFloat('network_out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_data');
    }
};
