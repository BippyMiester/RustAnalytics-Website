<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerKillsData extends Model
{
    use HasFactory;

    protected $table = "server_kills_data";

    public function server() {
        return $this->belongsTo(Server::class);
    }

    public function player() {
        return $this->belongsTo(ServerPlayerData::class,'steam_id', 'steam_id');
    }

}
