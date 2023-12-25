<?php

namespace App\Models;

use App\Models\Auth\User;
use Database\Factories\ServerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function serverdata() {
        return $this->hasMany(ServerData::class, 'server_id', 'id');
    }

    public function playerdata() {
        return $this->hasMany(PlayerData::class, 'server_id', 'id');
    }

    public function playerconnections() {
        return $this->hasMany(PlayerConnections::class, 'server_id', 'id');
    }

    public function playertime() {
        return $this->hasMany(PlayerTime::class, 'server_id', 'id');
    }

    public function animalkills() {
        return $this->hasMany(AnimalKills::class, 'server_id', 'id');
    }

    public function playercrafting() {
        return $this->hasMany(PlayerCrafting::class, 'server_id', 'id');
    }

    public function playerdeaths() {
        return $this->hasMany(PlayerDeaths::class, 'server_id', 'id');
    }

    public function destroyedbuildings() {
        return $this->hasMany(DestroyedBuildings::class, 'server_id', 'id');
    }

    public function destroyedcontainers() {
        return $this->hasMany(DestroyedContainers::class, 'server_id', 'id');
    }

    public function weaponfire() {
        return $this->hasMany(WeaponFire::class, 'server_id', 'id');
    }

    public function playergather() {
        return $this->hasMany(PlayerGather::class, 'server_id', 'id');
    }

    public function playerkills() {
        return $this->hasMany(PlayerKills::class, 'server_id', 'id');
    }

    public function placedstructures() {
        return $this->hasMany(PlacedStructures::class, 'server_id', 'id');
    }

    public function placeddeployables() {
        return $this->hasMany(PlacedDeployables::class, 'server_id', 'id');
    }
}
