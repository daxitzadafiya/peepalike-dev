<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blogs extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'id','blog_id','category_type','blog_title','blog_content','blog_tags','blog_author','blog_image','status','meta_tag','meta_description','views','created_at','updated_at'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::guard(config('app.guards.web'))->user()->id ;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::guard(config('app.guards.web'))->user()->id ;
        });
    }

    public $timestamps = true;
}
