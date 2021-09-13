<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotifications extends Model
{
    protected $table = 'notification_history';

    protected $fillable = [
        'id', 'user_id', 'message', 'isread', 'type','notificationStatus','SmsSid',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
