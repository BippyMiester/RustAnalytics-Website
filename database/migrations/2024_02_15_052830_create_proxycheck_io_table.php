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
        Schema::create('proxycheck_io', function (Blueprint $table) {
            $table->id();
            $table->string('asn');
            $table->string('ip_address');
            $table->string('range');
            $table->string('provider');
            $table->string('continent');
            $table->string('continent_code');
            $table->string('country');
            $table->string('isocode');
            $table->string('region');
            $table->string('regioncode');
            $table->string('timezone');
            $table->string('city');
            $table->string('postcode');
            $table->string('latitude');
            $table->string('longitude');
            $table->boolean('proxy');
            $table->string('type');
            $table->string('risk');
            $table->boolean('blocked');
            $table->string('block_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxycheck_io');
    }
};
