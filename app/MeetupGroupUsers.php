<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetupGroupUsers extends Model
{
    protected $table = 'meetup_group_users';

    protected $fillable = [
        'id', 'user_meetup_group_id', 'admin_user_id', 'meetup_user_id', 'is_approve','last_chat_message','request_accepted_by','request_rejected_by','request_by_name','unread_count',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
