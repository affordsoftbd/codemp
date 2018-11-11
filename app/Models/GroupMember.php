<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMember extends Model
{
    protected $table = 'group_details';
    protected $primaryKey = 'group_detail_id';
    public $timestamps = false;
}
