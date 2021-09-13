<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTags extends Model
{
    protected $table = 'blog_tags';

    protected $fillable = [
        'id','tag_name','status'
    ];

    public $timestamps = true;
}
