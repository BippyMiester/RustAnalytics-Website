<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerBan extends Model
{
    use HasFactory;

    protected $table = 'player_bans';

    public function server() {
        return $this->belongsTo(Server::class, 'id','server_id');
    }

    public function player() {
        return $this->belongsTo(PlayerConnections::class, 'steam_id', 'steam_id');
    }
}
