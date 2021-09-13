<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documnet extends Model
{
    protected $table='documnet';

    protected $fillable = [
        'id',
        'document_name',
        'created_at',
        'updated_at'
    ];
}
