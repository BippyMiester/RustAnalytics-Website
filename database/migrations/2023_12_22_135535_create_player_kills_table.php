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
        Schema::create('player_kills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->string('username');
            $table->unsignedBigInteger('steam_id');
            $table->unsignedBigInteger('kill_id');
            $table->string('victim');
            $table->string('weapon');
            $table->string('body_part');
            $table->unsignedBigInteger('distance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_kills_data');
    }
};
