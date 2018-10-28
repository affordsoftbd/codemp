<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    #one to many detail tabe relation
    public function followers()
    {
        return $this->hasMany(Follower::class,'leader_id');
    }
}
