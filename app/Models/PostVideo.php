<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostVideo extends Model
{
    protected $table = 'post_videos';
    protected $primaryKey = 'post_video_id';
    public $timestamps = false;
}
