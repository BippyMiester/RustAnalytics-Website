<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerAnimalKillData extends Model
{
    use HasFactory;

    protected $table = 'server_animal_kills';

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
