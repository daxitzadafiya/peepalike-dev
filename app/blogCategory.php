<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class blogCategory extends Model
{
    protected $table = 'blog_categories';

    protected $fillable = [
        'id','blog_id','category_id','category_name','category_type','category_description','category_image','is_active'
    ];

    // public function blogs()
    // {
    //     return $this->hasMany();
    // }
    // protected $dates = [
    //     'created_at',
    //     'updated_at'
    // ];

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
