<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'live_id',
        'threadname',
        'created_at',
        'updated_at',
        'deleted_at',
        ];
    
    public function user()
    {
        return $this->belongsTo(User::class);   
    }    
    
    public function live()
    {
        return $this->belongsTo(Live::class);
    }
    
    public function posts()   
    {
        return $this->hasMany(Post::class);  
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function getByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
}
