<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerConnections extends Model
{
    use HasFactory;

    /*
     * Define the table to be used by the model
     */
    protected $table = "player_connections";

    public function server() {
        return $this->belongsTo(Server::class);
    }

    public function playerdata() {
        return $this->hasMany(PlayerData::class, 'steam_id', 'steam_id');
    }

    public function playertime() {
        return $this->hasMany(PlayerTime::class, 'steam_id', 'steam_id');
    }

    public function animalkills() {
        return $this->hasMany(AnimalKills::class, 'steam_id', 'steam_id');
    }

    public function playercrafting() {
        return $this->hasMany(PlayerCrafting::class, 'steam_id', 'steam_id');
    }

    public function playerdeaths() {
        return $this->hasMany(PlayerDeaths::class, 'steam_id', 'steam_id');
    }

    public function destroyedbuildings() {
        return $this->hasMany(DestroyedBuildings::class, 'steam_id', 'steam_id');
    }

    public function destroyedcontainers() {
        return $this->hasMany(DestroyedContainers::class, 'steam_id', 'steam_id');
    }

    public function weaponfire() {
        return $this->hasMany(WeaponFire::class, 'steam_id', 'steam_id');
    }

    public function playergather() {
        return $this->hasMany(PlayerGather::class, 'steam_id', 'steam_id');
    }

    public function playerkills() {
        return $this->hasMany(PlayerKills::class, 'steam_id', 'steam_id');
    }

    public function placedstructures() {
        return $this->hasMany(PlacedStructures::class, 'steam_id', 'steam_id');
    }

    public function placeddeployables() {
        return $this->hasMany(PlacedDeployables::class, 'steam_id', 'steam_id');
    }
}
