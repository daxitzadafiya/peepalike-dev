<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAbuseReport extends Model
{
    protected $table = 'user_abuse_report';

    protected $fillable = [
        'id', 'type', 'user_id','event_id','group_id','user_comment','created_by','status','name',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
