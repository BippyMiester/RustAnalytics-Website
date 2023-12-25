<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerCrafting extends Model
{
    use HasFactory;

    /*
     * Define the table to be used by the model
     */
    protected $table = "player_crafting";

    public function server() {
        return $this->belongsTo(Server::class);
    }

    public function player() {
        return $this->belongsTo(PlayerConnections::class,'steam_id', 'steam_id');
    }
}
