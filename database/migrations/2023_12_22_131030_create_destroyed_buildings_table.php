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
        Schema::create('destroyed_buildings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->string('username');
            $table->unsignedBigInteger('steam_id');
            $table->string('owner');
            $table->string('type');
            $table->unsignedInteger('tier');
            $table->string('weapon');
            $table->string('grid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_destroyed_buildings_data');
    }
};
