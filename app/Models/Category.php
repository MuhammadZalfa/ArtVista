<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photo_category', 'category_id', 'photo_id');
    }
}