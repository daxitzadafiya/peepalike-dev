<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupchat extends Model
{
    protected $table = 'group_chat';

    protected $fillable = [
        'id', 'event_id', 'name', 'created_by', 'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
