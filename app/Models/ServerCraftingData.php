<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerCraftingData extends Model
{
    use HasFactory;

    protected $table = 'server_crafting_data';

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
