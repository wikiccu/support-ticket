<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'task_id', 'ticket_id','file_path','message', 'status'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
   }
   public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
