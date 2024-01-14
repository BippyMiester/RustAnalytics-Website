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
            $table->string('slug');
            $table->string('name')->default("New Server");
            $table->string('ip_address')->nullable();
            $table->integer('port')->nullable();
            $table->string('protocol')->nullable();
            $table->bigInteger('world_seed')->nullable();
            $table->text('world_name')->nullable();
            $table->unsignedBigInteger('map_size')->nullable();
            $table->dateTime('last_wiped')->nullable();
            $table->dateTime('blueprint_last_wiped')->nullable();
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
