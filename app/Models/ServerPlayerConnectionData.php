<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPlayerConnectionData extends Model
{
    use HasFactory;

    protected $table = 'server_player_connection_data';

    public function server() {
        return $this->belongsTo(Server::class);
    }

    public function playerdata() {
        return $this->hasMany(ServerPlayerData::class, 'steam_id', 'steam_id');
    }
}
