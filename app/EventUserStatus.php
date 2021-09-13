<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventUserStatus extends Model
{
    protected $table = 'event_user_status';

    protected $fillable = [
        'id', 'status_name', 'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
