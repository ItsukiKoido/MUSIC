<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'thread_id',
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
}
