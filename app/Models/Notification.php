<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id', // Add this line
        'type',
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at'
    ];
    
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];
}