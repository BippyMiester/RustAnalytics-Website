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
        return $this->hasMany(ServerData::class);
    }

    public function playerdata() {
        return $this->hasMany(ServerPlayerData::class);
    }

    public function animalkilldata() {
        return $this->hasMany(ServerAnimalKillData::class);
    }

    public function craftingdata() {
        return $this->hasMany(ServerCraftingData::class);
    }

    public function playerdeathdata() {
        return $this->hasMany(ServerPlayerDeathData::class);
    }

    public function destroyedbuildingsdata() {
        return $this->hasMany(ServerDestroyedBuildingsData::class);
    }

    public function destroyedcontainersdata() {
        return $this->hasMany(ServerDestroyedContainersData::class);
    }

    public function weaponfiredata() {
        return $this->hasMany(ServerWeaponFireData::class);
    }

    public function playergatherdata() {
        return $this->hasMany(ServerPlayerGatherData::class);
    }

    public function killsdata() {
        return $this->hasMany(ServerKillsData::class);
    }

    public function placedstructuresdata() {
        return $this->hasMany(ServerPlacedStructuresData::class);
    }

    public function placeddeployablesdata() {
        return $this->hasMany(ServerPlacedDeployablesData::class);
    }
}
