<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this line

class Photo extends Model
{
    use SoftDeletes; // Add this line
    
    protected $table = 'photos';
    protected $primaryKey = 'photo_id';

    protected $fillable = [
        'album_id',
        'user_id',
        'title',
        'category',
        'description',
        'image_path'
    ];

    protected $dates = ['deleted_at']; // Add this line

    // Daftar kategori yang tersedia
    public static $categories = [
        'landscape' => 'Landscape & Nature',
        'portrait' => 'Portrait & People',
        'architecture' => 'Architecture & Urban',
        'events' => 'Events & Occasions',
        'lifestyle' => 'Lifestyle & Fashion',
        'food' => 'Food & Cuisine',
        'art' => 'Art & Abstract',
        'product' => 'Product & Commercial',
        'travel' => 'Travel & Adventure',
        'automotive' => 'Automotive & Transport',
        'wildlife' => 'Wildlife & Animals',
        'sports' => 'Sports & Action',
        'documentary' => 'Documentary & Stories',
        'aerial' => 'Aerial & Drone',
        'night' => 'Night & Low Light',
        'underwater' => 'Underwater & Marine'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'album_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}