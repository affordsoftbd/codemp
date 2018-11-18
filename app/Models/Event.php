<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    protected $table = "events";

    protected $fillable = ['title', 'details', 'event_image', 'event_date', 'user_id'];

    use SoftDeletes;

    public function scopeSearch($query, $search='')
    {
        if (empty($search)) {
            return $query;
        } else {
            return $query->where('title', 'LIKE', '%' . $search . '%');
        }
    }

        // A MessageSubject has an organizer
    public function organizer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        // A MessageSubject has many messages
    public function comments()
    {
        return $this->hasMany(EventComment::class);
    }

        // An event belongs to many participants
    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_participants');
    }
}
