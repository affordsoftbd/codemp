<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    public $timestamps = false;

    #one to many detail tabe relation
    public function members()
    {
        return $this->hasMany(GroupMember::class,'group_id');
    }
}
