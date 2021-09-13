<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password', 'mobile', 'image', 'login_type', 'status', 'otp', 'remember_token', 'created_at', 'updated_at', 'country_code', 'latitude', 'longitude', 'fcm_token', 'wallet', 'google_token', 'facebook_token', 'os_type', 'stripe_payment_account', 'isOnline', 'socketID', 'lastseen', 'voipToken', 'token', 'age', 'address', 'gender', 'max_distance', 'interest', 'age_interest','description','msg_count','notification_count','badge_count','plan_id','profile_view_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'accountType','created_at', 'updated_at','socialToken', 'deviceToken'
    ];
}
