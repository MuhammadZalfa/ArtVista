<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'photo_id';
    protected $fillable = ['album_id', 'user_id', 'title', 'description', 'image_path'];

    public function likes()
    {
        return $this->hasMany(Like::class, 'photo_id', 'photo_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'photo_id', 'photo_id');
    }

    public function shares()
    {
        return $this->hasMany(Share::class, 'photo_id', 'photo_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'photo_category', 'photo_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'album_id');
    }

    // Scope untuk menghitung jumlah likes
    public function scopeWithLikesCount($query)
    {
        return $query->withCount(['likes' => function($q) {
            $q->where('photo_id', $this->photo_id);
        }]);
    }
}