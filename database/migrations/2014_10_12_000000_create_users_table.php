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
            $table->string('discriminator');
            $table->string('fullusername');
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->boolean('email_verified');
            $table->string('locale');
            $table->boolean('twofactor');
            $table->boolean('admin')->default(false);
            $table->boolean('tos_accept')->default(false);
            $table->timestamp('tos_accept_date')->nullable();
            $table->boolean('privacy_accept')->default(false);
            $table->timestamp('privacy_accept_date')->nullable();
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
