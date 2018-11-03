<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'user_detail_id';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
