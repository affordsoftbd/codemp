<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_images';
    protected $primaryKey = 'post_image_id';
    public $timestamps = false;
}
