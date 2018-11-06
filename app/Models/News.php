<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{

    protected $table = "global_news";

    protected $primaryKey = 'global_news_id';

    #one to many detail tabe relation
    public function comments()
    {
        return $this->hasMany(NewsComment::class,'news_id');
    }

}
