<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerWeaponFireData extends Model
{
    use HasFactory;

    protected $table = "server_weapon_fire_data";

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
