<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function userIndex()
    {
        $albums = Album::where('user_id', Auth::id())->latest()->get();
        return view('pages.profile', compact('albums'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $album = Album::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Album berhasil ditambahkan',
            'album' => $album
        ]);
    }

    public function showUserAlbum($album_id)
    {
        $album = Album::findOrFail($album_id);
        
        return view('pages.buka', [
            'album' => $album
        ]);
    }
}