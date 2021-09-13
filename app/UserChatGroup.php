<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChatGroup extends Model
{
    protected $table = 'user_chat_group';

    protected $fillable = [
        'id', 'event_id', 'group_id', 'user_id', 'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
