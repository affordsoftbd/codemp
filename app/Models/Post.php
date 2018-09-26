<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    public $timestamps = false;


    #one to many detail tabe relation
    public function images()
    {
        return $this->hasMany(PostImage::class,'post_id');
    }

    #one to many detail tabe relation
    public function videos()
    {
        return $this->hasMany(PostVideo::class,'post_id');
    }

    #one to many detail tabe relation
   	public function comments()
    {
        return $this->hasMany(PostComment::class,'post_id');
    }

    #one to many detail tabe relation
   	public function likes()
    {
        return $this->hasMany(PostLike::class,'post_id');
    }
}
