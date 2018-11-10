<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = 'followers';
    protected $primaryKey = 'follower_id';
    public $timestamps = false;

    	// Each Follower belongs to a user
	public function user()
	{
		return $this->belongsTo(User::class, 'follower_user_id');
	}
}
