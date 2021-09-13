<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $hidden = [
        'country_id',
    ];
}
