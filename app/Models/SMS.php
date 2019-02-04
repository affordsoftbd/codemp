<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $table = "bulk_sms";

    protected $fillable = ['message', 'sender_id', 'receiver_id', 'content_id', 'content_type'];

    	// Each Sent SMS belongs to a user
	public function user()
	{
		return $this->belongsTo(User::class, 'sender_id');
	}
   
}