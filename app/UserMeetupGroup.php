<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeetupGroup extends Model
{
    protected $table = 'user_meetup_group';

    protected $fillable = [
        'id', 'user_id', 'event_id', 'group_name', 'description', 'status', 
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
