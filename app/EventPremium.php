<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPremium extends Model
{
    protected $table = 'event_premium';

    protected $fillable = [
        'id', 'plan_name', 'description', 'duration', 'price',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
