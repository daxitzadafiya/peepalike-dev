<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfileView extends Model
{
    protected $table = 'user_profile_view';

    protected $fillable = [
        'id', 'user_id', 'view_user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
