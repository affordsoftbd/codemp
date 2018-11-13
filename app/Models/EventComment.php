<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventComment extends Model
{
    protected $table = "event_comments";

    protected $fillable = ['comment', 'event_id', 'user_id'];

    use SoftDeletes;

        // A comment belongs to an event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

        // A comment belongs to an user
    public function comments()
    {
        return $this->belongsTo(User::class);
    }
}
