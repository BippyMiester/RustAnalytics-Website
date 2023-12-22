<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPlayerDeathData extends Model
{
    use HasFactory;

    protected $table = 'server_player_death_data';

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
