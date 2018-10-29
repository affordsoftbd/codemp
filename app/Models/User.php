<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    	// one to many detail tabe relation
    public function followers()
    {
        return $this->hasMany(Follower::class,'leader_id');
    }

        // A User perticipated in many messages
    public function messages()
    {
        return $this->hasMany(MessageReceipent::class);
    }

        // A User perticipated in many messages subjects
    public function messageSubjects() {
        return $this->belongsToMany(MessageSubject::class, 'message_receipients');
    }
}
