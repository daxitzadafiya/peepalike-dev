<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smslogs extends Model
{
    protected $table = 'sms_logs';

    protected $fillable = [
        'id','channel_id', 'user_id', 'group_id', 'event_id', 'sender_id', 'receiver_id', 'type', 'chat_type', 'msg_body', 'media_url', 'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
