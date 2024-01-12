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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('api_key');
            $table->string('name');
            $table->string('ip_address');
            $table->integer('port');
            $table->string('protocol');
            $table->bigInteger('world_seed');
            $table->text('world_name');
            $table->unsignedBigInteger('map_size');
            $table->dateTime('last_wiped');
            $table->dateTime('blueprint_last_wiped');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
