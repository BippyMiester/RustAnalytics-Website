<?php

use App\Models\PusherTimeout;
use App\Models\Server;
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
        Schema::create('pusher_timeouts', function (Blueprint $table) {
            $table->id();
            $table->string('api_key');
            $table->unsignedBigInteger('count')->default(0);
            $table->timestamps();
        });

        $servers = Server::all();

        foreach($servers as $server) {
            $timeout = new PusherTimeout;
            $timeout->api_key = $server->api_key;
            $timeout->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pusher_timeouts');
    }
};
