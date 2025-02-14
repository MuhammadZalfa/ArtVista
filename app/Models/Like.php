<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id', 
        'photo_id'
    ];

    // Karena hanya ada created_at column
    const UPDATED_AT = null;

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'photo_id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}