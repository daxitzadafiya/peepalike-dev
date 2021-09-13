<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userprofileimage extends Model
{
    protected $table = 'user_profile_image';

    protected $fillable = [
        'id', 'user_id', 'profile_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
