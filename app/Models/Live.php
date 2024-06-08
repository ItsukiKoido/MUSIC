<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Live extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'artist_id',
        'livename',
        'prace',
        'date',
        'time',
        'created_at',
        'updated_at',
        'deleted_at',
        ];
    
    public function playlists()
    {
        return $this->hasMany(Playlist::class);    
    }  
        
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
    
    public function threads()   
    {
        return $this->hasMany(Thread::class);  
    }
        
}
