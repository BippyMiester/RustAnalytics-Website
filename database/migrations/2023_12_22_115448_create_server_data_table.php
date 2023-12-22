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
            $table->unsignedBigInteger('frame_rate');
            $table->unsignedBigInteger('memory');
            $table->unsignedBigInteger('player_count');
            $table->unsignedBigInteger('entities');
            $table->unsignedBigInteger('average_client_latency');
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
