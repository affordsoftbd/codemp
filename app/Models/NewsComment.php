<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsComment extends Model
{

    protected $table = "global_news_comments";

    protected $primaryKey = 'global_news_comment_id';

    protected $fillable = ['comment', 'user_id', 'news_id'];

        // A comment belongs to a creator
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    	// A comment belongs to a news
    public function news()
    {
        return $this->belongsTo(News::class, 'news_id', 'global_news_id');
    }

}
