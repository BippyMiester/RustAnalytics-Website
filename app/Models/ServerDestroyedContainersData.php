<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerDestroyedContainersData extends Model
{
    use HasFactory;

    protected $table = 'server_destroyed_containers_data';

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
