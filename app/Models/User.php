<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_photo',
        'access_level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship untuk likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Relationship untuk albums
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    // Relationship untuk photos
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}