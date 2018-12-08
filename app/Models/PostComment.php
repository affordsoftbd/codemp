<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $table = 'post_comments';
    protected $primaryKey = 'post_comment_id';
    public $timestamps = false;

    protected $fillable = ['comment', 'parent_id', 'post_id', 'user_id'];
}
