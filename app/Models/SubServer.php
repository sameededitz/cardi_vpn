<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'name',
        'config',
        'ip_address',
        'panel_address',
        'password',
    ];

    /**
     * Get the server that owns the sub-server.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
