<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageSubject extends Model
{
    protected $table = "message_subjects";

    protected $fillable = ['subject_text', 'author'];

    use SoftDeletes;

    public function scopeSearch($query, $search='')
    {
        if (empty($search)) {
            return $query;
        } else {
            return $query->where('subject', 'LIKE', '%' . $search . '%');
        }
    }

        // A MessageSubject has a creator 
    public function subjectAuthor()
    {
        return $this->belongsTo(User::class, 'author');
    }

        // A MessageSubject has many messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

        // A MessageSubject has many receipents
    public function receipents()
    {
        return $this->belongsToMany(User::class, 'message_receipients');
    }
}
