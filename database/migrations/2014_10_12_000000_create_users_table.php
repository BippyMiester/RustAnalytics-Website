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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('provider');
            $table->string('provider_id');
            $table->string('username');
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->string('locale')->default("en-US");
            $table->boolean('twofactor')->nullable();
            $table->boolean('admin')->default(false);
            $table->boolean('tos_accept')->default(true);
            $table->timestamp('tos_accept_date')->default(now());
            $table->boolean('privacy_accept')->default(true);
            $table->timestamp('privacy_accept_date')->default(now());
            $table->boolean('news_notifications')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
