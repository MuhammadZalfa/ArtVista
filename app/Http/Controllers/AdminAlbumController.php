<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Category;
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
        $categories = Category::all(); // Ambil semua kategori dari database
        
        return view('admin.album', compact('album', 'photos', 'categories')); // Kirim kategori ke view
    }
    
    public function storePhoto(Request $request)
    {
        try {
            // Validasi input form
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'category' => 'required|array',
                'category.*' => 'exists:categories,category_id',
                'description' => 'nullable|string',
                'album_id' => 'required|exists:albums,album_id'
            ]);
    
            \DB::beginTransaction(); // Mulai transaction
    
            // Simpan gambar
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('photos', $filename, 'public');
    
            // Membuat foto baru
            $photo = Photo::create([
                'album_id' => $validated['album_id'],
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image_path' => $path
            ]);
    
            // Debug: Print categories yang akan di-attach
            \Log::info('Categories to attach:', $request->category);
    
            // Attach categories ke photo
            foreach ($request->category as $categoryId) {
                \DB::table('photo_category')->insert([
                    'photo_id' => $photo->photo_id,
                    'category_id' => $categoryId,
                    'created_at' => now()
                ]);
            }
    
            \DB::commit(); // Commit transaction
    
            return redirect()->back()->with('success', 'Foto berhasil diunggah');
            
        } catch (\Exception $e) {
            \DB::rollBack(); // Rollback jika ada error
            \Log::error('Error uploading photo: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal mengunggah foto: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function showPhoto($id)
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
        $isLiked = auth()->user()->likes()->where('photo_id', $id)->exists();
        $comments = $photo->comments()->with('user')->latest()->get();

        return view('admin.buka', compact(
            'photo',
            'photos',
            'categories',
            'likeCount',
            'shareCount',
            'isLiked',
            'comments'
        ));
    }

    public function toggleLike(Photo $photo)
    {
        $user = auth()->user();
        $existingLike = $user->likes()->where('photo_id', $photo->photo_id)->first();

        if ($existingLike) {
            $existingLike->delete();
            $isLiked = false;
        } else {
            $user->likes()->create(['photo_id' => $photo->photo_id]);
            $isLiked = true;
        }

        return response()->json([
            'likeCount' => $photo->likes()->count(),
            'isLiked' => $isLiked
        ]);
    }

    public function handleShare(Photo $photo)
    {
        $user = auth()->user();
        
        $user->shares()->create([
            'photo_id' => $photo->photo_id,
            'share_type' => 'link'
        ]);

        return response()->json([
            'shareCount' => $photo->shares()->count(),
            'message' => 'Foto berhasil dibagikan'
        ]);
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

    public function updateAlbum(Request $request, $album_id)
    {
        try {
            $album = Album::findOrFail($album_id);
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string'
            ]);

            $album->update($validated);

            return redirect()->route('adminAlbum', $album_id)->with('success', 'Album berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui album: ' . $e->getMessage());
        }
    }

    public function deleteAlbum($album_id)
    {
        try {
            $album = Album::findOrFail($album_id);
            
            // Optional: Hapus semua foto di album ini terlebih dahulu
            $album->photos()->delete();
            
            $album->delete();

            return redirect()->route('profileAdmin')->with('success', 'Album berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus album: ' . $e->getMessage());
        }
    }

    public function updatePhoto(Request $request, $photoId)
    {
        try {
            $photo = Photo::findOrFail($photoId);
            
            // Pastikan hanya pemilik foto yang bisa mengupdate
            if ($photo->user_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah foto ini');
            }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|array',
                'category.*' => 'exists:categories,category_id'
            ]);

            // Update foto
            $photo->update([
                'title' => $validated['title'],
                'description' => $validated['description']
            ]);

            // Sync kategori
            $photo->categories()->sync($validated['category']);

            return redirect()->back()->with('success', 'Foto berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui foto: ' . $e->getMessage());
        }
    }
}