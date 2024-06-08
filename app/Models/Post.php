<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'thread_id',
        'body',
        'created_at',
        'updated_at',
        'deleted_at',
        ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
    
    public function comments()   
    {
        return $this->hasMany(Comment::class);  
    }
}
