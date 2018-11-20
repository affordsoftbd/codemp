<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyLeader extends Model
{
    protected $table = 'my_leaders';
    protected $primaryKey = 'my_leader_id';
    public $timestamps = false;
}
