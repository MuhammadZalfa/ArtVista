<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'comment_id';
    protected $fillable = ['user_id', 'photo_id', 'comment_text'];
    
    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'photo_id');
    }
}