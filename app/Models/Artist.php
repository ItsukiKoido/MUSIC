<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'name',
        'explanation',
        'image_path',
        'created_at',
        'updated_at',
        'deleted_at',
        ];
    
    
    public function lives()   
    {
        return $this->hasMany(Live::class);  
    }
    
}
