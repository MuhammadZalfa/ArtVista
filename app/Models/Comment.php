<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'comment_id';
    protected $fillable = ['user_id', 'photo_id', 'comment_text'];
    
    // Only if you want to disable updated_at timestamp since your table only has created_at
    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }
}