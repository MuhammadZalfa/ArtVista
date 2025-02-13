<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class PenggunaController extends Controller
{
    public function dashboard()
    {
        $albums = Album::with(['photos' => function($query) {
            $query->latest()->limit(1); // Get the latest photo for each album
        }])
        ->withCount('photos')
        ->orderBy('created_at', 'desc')
        ->paginate(3); // Limit to 3 albums per page
    
        $photos = Photo::select('photos.*')
            ->withCount('likes')
            ->with('album')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('welcome', compact('albums', 'photos'));
    }

    public function PhotoPages()
    {
        $photos = Photo::select('photos.*')
            ->withCount('likes')
            ->with('album')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.main', compact('photos'));
    }
    public function albumDiscovery()
    {
        $albums = Album::with(['photos' => function($query) {
            $query->latest(); // Get the latest photo for each album
        }])
        ->withCount('photos')
        ->orderBy('created_at', 'desc')
        ->paginate();

        return view('pages.albumDiscovery', compact('albums'));
    }
    public function showPhotos($id)
    {
        // Get the current photo with its relationships
        $photo = Photo::with(['comments' => function($query) {
            $query->with('user');
        }, 'likes', 'shares', 'categories'])
        ->where('photo_id', $id)
        ->firstOrFail();
    
        // Get all photos except the current one, for the grid display
        $photos = Photo::where('photo_id', '!=', $id)
            ->latest()
            ->get();
    
        // Fetch all categories for the edit modal
        $categories = Category::all();
    
        $likeCount = $photo->likes->count();
        $shareCount = $photo->shares->count();
        
        // Check if a user is authenticated before calling likes()
        $isLiked = false;
        if (auth()->check()) {
            $isLiked = auth()->user()->likes()->where('photo_id', $id)->exists();
        }
        
        $comments = $photo->comments()->with('user')->latest()->get();
    
        return view('pages.buka', compact(
            'photo',
            'photos',
            'categories',
            'likeCount',
            'shareCount',
            'isLiked',
            'comments'
        ));
    }
}