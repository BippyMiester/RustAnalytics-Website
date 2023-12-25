<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPlayerData extends Model
{
    use HasFactory;

    public function server() {
        return $this->belongsTo(Server::class, 'id', 'server_id');
    }

    // Link to all server data models that have to do with player data
    public function playerconnectiondata() {
        return $this->belongsTo(ServerPlayerConnectionData::class,'steam_id', 'steam_id');
    }

    public function animalkillsdata() {
        return $this->hasMany(ServerAnimalKillData::class,'steam_id', 'steam_id');
    }

    public function craftingdata() {
        return $this->hasMany(ServerCraftingData::class,'steam_id', 'steam_id');
    }

    public function destroyedbuildingsdata() {
        return $this->hasMany(ServerDestroyedBuildingsData::class,'steam_id', 'steam_id');
    }

    public function destroyedcontainersdata() {
        return $this->hasMany(ServerDestroyedContainersData::class,'steam_id', 'steam_id');
    }

    public function killsdata() {
        return $this->hasMany(ServerKillsData::class,'steam_id', 'steam_id');
    }

    public function placeddeployablesdata() {
        return $this->hasMany(ServerPlacedDeployablesData::class,'steam_id', 'steam_id');
    }

    public function placedstructuresdata() {
        return $this->hasMany(ServerPlacedStructuresData::class,'steam_id', 'steam_id');
    }

    public function deathdata() {
        return $this->hasMany(ServerPlayerDeathData::class,'steam_id', 'steam_id');
    }

    public function gatherdata() {
        return $this->hasMany(ServerPlayerGatherData::class,'steam_id', 'steam_id');
    }

    public function weaponfiredata() {
        return $this->hasMany(ServerWeaponFireData::class,'steam_id', 'steam_id');
    }
}
