<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotificationHistory extends Model
{
    protected $table = 'push_notification_history';

    protected $fillable = [
        'id', 'user_id', 'message', 'status', 'type','other_type','other_id','other_name','sender_name','receiver_name','sender_id','receiver_id','group_name','group_id','event_id','request_accepted_by','request_rejected_by','request_by_name',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
