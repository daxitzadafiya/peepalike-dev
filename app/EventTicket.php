<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $table = 'event_ticket';

    protected $fillable = [
        'id', 'event_id', 'ticket_type', 'ticket_name', 'available_quantity', 'ticket_price', 'description', 'visibility', 'minimum_quantity', 'maximum_quantity', 'sales_start_date', 'sales_start_time', 'sales_end_date', 'sales_end_time',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
