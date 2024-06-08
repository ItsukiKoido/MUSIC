<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at',
        ];
    
    public function user()
{
    return $this->belongsTo(User::class);
}

public function post()
{
    return $this->belongsTo(Post::class);
}
    
}
