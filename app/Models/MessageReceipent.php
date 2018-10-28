<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageReceipent extends Model
{
    protected $table = "message_receipients";

    protected $fillable = ['message_subject_id', 'user_id'];

    use SoftDeletes;

    	// Each MessageParticipant belongs to a subject
	public function message_subject()
	{
		return $this->belongsTo(MessageSubject::class);
	}

		// Each participation belongs to a user
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
