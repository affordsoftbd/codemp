<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMember extends Model
{
    protected $table = 'group_members';
    protected $primaryKey = 'group_member_id';
    public $timestamps = false;

        // A group member belongs to a user 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
