<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Jobs extends Model
{
    
    protected $table='jobs';
    
    public function getDateFormat()
    {
        return 'Y-d-m';
    }

    public $timestamps  = false;
}