<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeetup extends Model
{
    protected $table = 'user_meetup';

    protected $fillable = [
        'id', 'user_id', 'meetup_user_id', 
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
