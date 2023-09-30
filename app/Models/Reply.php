<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply_id',
        'thread_id',
        'body'
    ];
    //a reply is come from user
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    //a reply have a lot of answer 
    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
