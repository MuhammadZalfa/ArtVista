<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminAlbumController extends Controller
{
    public function adminIndex()
    {
        $albums = Album::where('user_id', Auth::id())->latest()->get();
        return view('admin.profilAdmin', compact('albums'));
    }

    public function adminStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
    
            $album = Album::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Album berhasil ditambahkan',
                'album' => $album
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating album: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat album: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showAdminAlbum($album_id)
    {
        $album = Album::findOrFail($album_id);
        $photos = Photo::where('album_id', $album_id)->latest()->get();
        
        return view('admin.album', compact('album', 'photos'));
    }

    public function storePhoto(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'category' => 'required|string|max:50', // Tambah validasi category
                'description' => 'nullable|string',
                'album_id' => 'required|exists:albums,album_id'
            ]);
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                
                $path = $image->storeAs('photos', $filename, 'public');
                
                Photo::create([
                    'album_id' => $validated['album_id'],
                    'user_id' => Auth::id(),
                    'title' => $validated['title'],
                    'category' => $validated['category'], // Tambah ini
                    'description' => $validated['description'],
                    'image_path' => $path
                ]);
    
                return redirect()->back()->with('success', 'Foto berhasil diunggah');
            }
    
            return redirect()->back()
                ->with('error', 'Tidak ada file yang diunggah')
                ->withInput();
    
        } catch (\Exception $e) {
            \Log::error('Error saat upload foto: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal mengunggah foto: ' . $e->getMessage())
                ->withInput();
        }
    }
// app/Http/Controllers/AdminAlbumController.php - Add or update this method:
public function showPhoto($id)
{
    // Get photo directly since category is in photos table
    $photo = Photo::findOrFail($id);
    
    // Fetch comments for this specific photo
    $comments = Comment::where('photo_id', $id)
                      ->join('users', 'comments.user_id', '=', 'users.id')
                      ->select('comments.*', 'users.name')
                      ->orderBy('created_at', 'desc')
                      ->get();

    return view('admin.buka', compact('photo', 'comments'));
}

public function storeComment(Request $request, $id)
{
    $request->validate([
        'comment_text' => 'required|string'
    ]);

    Comment::create([
        'photo_id' => $id,
        'user_id' => auth()->id(),
        'comment_text' => $request->comment_text
    ]);

    return back();
}

public function deletePhoto($photoId)
{
    $photo = Photo::findOrFail($photoId);
    $albumId = $photo->album_id; // Ambil album_id sebelum foto dihapus
    
    $photo->delete();
    
    // Redirect ke halaman album dengan pesan sukses
    return redirect()->route('adminAlbum', $albumId)->with('success', 'Foto telah dipindahkan ke sampah');
}
}