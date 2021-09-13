<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Providerreviews extends Model
{
    protected $table='provider_reviews';
	
	
	
	public function user()
    {
        return $this->belongsTo(User::class)->select(array('id', 'first_name', 'last_name'));
    }
	
	/*
	public function booking()
    {
        return $this->belongsTo(Bookings::class);
    }*/
	
	
	
}
