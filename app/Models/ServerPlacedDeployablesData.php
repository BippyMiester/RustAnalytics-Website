<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPlacedDeployablesData extends Model
{
    use HasFactory;

    protected $table = "server_placed_deployables_data";

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
