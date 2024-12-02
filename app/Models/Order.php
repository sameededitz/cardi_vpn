<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'orders';

    // The attributes that are mass assignable.
    protected $fillable = [
        'id',
        'create_date',
        'is_premium'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'create_date' => 'datetime',
        'is_premium' => 'boolean',
    ];

    // Custom primary key type
    protected $keyType = 'string';

    // Indicates if the IDs are auto-incrementing.
    public $incrementing = false;
}
