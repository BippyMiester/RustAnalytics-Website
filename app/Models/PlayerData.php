<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerData extends Model
{
    use HasFactory;

    /*
     * Define the table to be used by the model
     */
    protected $table = "player_data";

    public function server() {
        return $this->belongsTo(Server::class, 'id', 'server_id');
    }

    // Link to all server data models that have to do with player data
    public function player() {
        return $this->belongsTo(PlayerConnections::class,'steam_id', 'steam_id');
    }
}
