<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserEvents extends Model
{
    protected $table = 'user_events';

    protected $fillable = [
        'id', 'user_id', 'event_name', 'vanue_name', 'event_start_date', 'event_start_time', 'event_end_date', 'event_end_time', 'event_image', 'event_location', 'address', 'city', 'state', 'postal_code', 'country', 'latitude', 'longitude', 'distance', 'description', 'status', 'event_rating' ,'is_trending_event','ecid',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $guarded = ['*'];
    public $timestamps = true;
    public function getuserDetails()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
