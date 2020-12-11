<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title','user_id','priority','ticket_id','file_path','message', 'status'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
   }
   public function comments()
   {
       return $this->hasMany(Taskcomment::class);
   }
}
