<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsComment extends Model
{

    protected $table = "global_news_comments";

    protected $primaryKey = 'global_news_comment_id';

}
