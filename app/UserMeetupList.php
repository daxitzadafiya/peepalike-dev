<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeetupList extends Model
{
    protected $table = 'user_meetup_list';

    protected $fillable = [
        'id', 'user_id', 'meetup_user_id', 'user_meetup_id', 'is_approve', 'status', 'unread_count','last_chat_message','last_chat_type','last_chat_time',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
