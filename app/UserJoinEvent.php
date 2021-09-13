<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserJoinEvent extends Model
{
    protected $table = 'user_join_event';

    protected $fillable = [
        'id', 'user_id', 'event_id', 'status', 'unread_count',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
