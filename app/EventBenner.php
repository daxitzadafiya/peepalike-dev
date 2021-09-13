<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventBenner extends Model
{
    protected $table = 'event_benner';

    protected $fillable = [
        'id', 'event_id', 'banner_image', 'status', 
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
