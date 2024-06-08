<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'live_id',
        'spotify_id',
        'created_at',
        'updated_at',
        'deleted_at',
        ];
        
        
    public function live()
    {
        return $this->belongsTo(Live::class);    
        
    }   
}
