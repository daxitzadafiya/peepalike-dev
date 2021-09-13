<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderDocument extends Model
{
    protected $table='provider_document';

    protected $fillable = [
        'id',
        'provider_id',
        'document_id',
        'status',
        'created_at',
        'updated_at'
    ];
    
    public function documents()
    {
    	return $this->hasMany(Documnet::class, 'id', 'document_id');
    }
}
