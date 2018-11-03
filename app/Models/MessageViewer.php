<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageViewer extends Model
{
    protected $table = "message_viewers";

    protected $fillable = ['message_id', 'viewer'];

    	
    	// Each MessageViewer belongs to a message
	public function message()
	{
		return $this->belongsTo(Message::class);
	}

    	// Each MessageViewer belongs to a user
	public function user()
	{
		return $this->belongsTo(User::class, 'viewer');
	}
}
