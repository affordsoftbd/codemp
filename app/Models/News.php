<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{

    protected $table = "global_news";

    protected $primaryKey = 'global_news_id';

        // A News belongs to a creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    	// A News has a many comments
    public function comments()
    {
        return $this->hasMany(NewsComment::class, 'news_id');
    }

}
