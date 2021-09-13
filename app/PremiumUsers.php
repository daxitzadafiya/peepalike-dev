<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumUsers extends Model
{
    protected $table = 'premium_users';

    protected $fillable = [
        'id', 'user_id', 'event_premium_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
