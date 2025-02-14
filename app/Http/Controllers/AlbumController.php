<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Album;
use App\Models\Photo;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{
    public function userIndex()
{
    try {
        $userId = Auth::id();
        
        // Get albums and photos owned by user
        $albums = Album::where('user_id', $userId)->latest()->get();
        
        // Get total likes from photos owned by the user
        $totalLikes = Like::join('photos', 'likes.photo_id', '=', 'photos.photo_id')
                         ->where('photos.user_id', $userId)
                         ->count();

        $userStats = (object)[
            'albums_count' => $albums->count(),
            'photos_count' => Photo::where('user_id', $userId)->count(),
            'total_likes_received' => $totalLikes
        ];

        return view('pages.profile', compact('albums', 'userStats'));
        
    } catch (\Exception $e) {
        Log::error('Error fetching user albums: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Gagal memuat album');
    }
}

    public function storeAlbum(Request $request)
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
            Log::error('Error creating album: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat album: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showUserAlbum($album_id)
    {
        try {
            $album = Album::findOrFail($album_id);
            $photos = Photo::where('album_id', $album_id)->latest()->get();
            $categories = Category::all();
            
            return view('pages.album', compact('album', 'photos', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error showing user album: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat album');
        }
    }

    public function storePhoto(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'title' => 'required|string|max:255',
                'category' => 'required|array',
                'category.*' => 'exists:categories,category_id',
                'description' => 'nullable|string',
                'album_id' => 'required|exists:albums,album_id'
            ]);

            \DB::beginTransaction();

            // Ensure storage directory exists
            $storagePath = storage_path('app/public/photos');
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }

            $image = $request->file('image');
            $fileSize = $image->getSize() / 1024 / 1024; // Convert to MB
            $shouldCompress = $request->has('compress');

            if ($fileSize > 2 && $shouldCompress) {
                $filename = time() . '_' . uniqid() . '_compressed_' . $image->getClientOriginalName();
                $path = 'photos/' . $filename;
                
                $imageContent = file_get_contents($image->getRealPath());
                if ($imageContent === false) {
                    throw new \Exception('Failed to read image file');
                }
                
                $img = @imagecreatefromstring($imageContent);
                if (!$img) {
                    throw new \Exception('Failed to create image from string');
                }
                
                $width = imagesx($img);
                $height = imagesy($img);
                
                $maxDimension = 1600;
                $newWidth = $width;
                $newHeight = $height;
                
                if ($width > $maxDimension || $height > $maxDimension) {
                    if ($width > $height) {
                        $newWidth = $maxDimension;
                        $newHeight = ($height / $width) * $maxDimension;
                    } else {
                        $newHeight = $maxDimension;
                        $newWidth = ($width / $height) * $maxDimension;
                    }
                }
                
                $newImg = imagecreatetruecolor($newWidth, $newHeight);
                if (!$newImg) {
                    throw new \Exception('Failed to create new image');
                }
                
                if ($image->getClientMimeType() == 'image/png') {
                    imagealphablending($newImg, false);
                    imagesavealpha($newImg, true);
                    $transparent = imagecolorallocatealpha($newImg, 0, 0, 0, 127);
                    imagefilledrectangle($newImg, 0, 0, $newWidth, $newHeight, $transparent);
                }
                
                if (!imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height)) {
                    throw new \Exception('Failed to resize image');
                }
                
                ob_start();
                $success = false;
                
                switch ($image->getClientMimeType()) {
                    case 'image/jpeg':
                        $success = imagejpeg($newImg, null, 60);
                        break;
                    case 'image/png':
                        $success = imagepng($newImg, null, 6);
                        break;
                    case 'image/gif':
                        $success = imagegif($newImg);
                        break;
                }
                
                if (!$success) {
                    throw new \Exception('Failed to compress image');
                }
                
                $imageData = ob_get_clean();
                
                if (!Storage::disk('public')->put($path, $imageData)) {
                    throw new \Exception('Failed to save compressed image');
                }
                
                imagedestroy($img);
                imagedestroy($newImg);
                
            } else {
                $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('photos', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store original image');
                }
            }

            $photo = Photo::create([
                'album_id' => $validated['album_id'],
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'image_path' => $path
            ]);

            if (!$photo) {
                throw new \Exception('Failed to create photo record');
            }

            foreach ($request->category as $categoryId) {
                if (!\DB::table('photo_category')->insert([
                    'photo_id' => $photo->photo_id,
                    'category_id' => $categoryId,
                    'created_at' => now()
                ])) {
                    throw new \Exception('Failed to attach category');
                }
            }

            \DB::commit();

            $message = 'Foto berhasil diunggah';
            if ($fileSize > 2 && $shouldCompress) {
                $message .= ' dan dikompresi';
            }

            return redirect()->back()->with('success', $message);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            Log::error('Error uploading photo: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal mengunggah foto: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Add this method to AlbumController.php
    public function toggleLike($photoId)
{
    try {
        $userId = Auth::id();
        Log::info('Toggle Like - User ID: ' . $userId . ', Photo ID: ' . $photoId);
        
        $photo = Photo::findOrFail($photoId);
        
        $existingLike = Like::where('user_id', $userId)
            ->where('photo_id', $photoId)
            ->first();

        if ($existingLike) {
            Log::info('Deleting existing like');
            $existingLike->delete();
        } else {
            Log::info('Creating new like');
            Like::create([
                'user_id' => $userId,
                'photo_id' => $photoId
            ]);
        }

        return redirect()->back();
    } catch (\Exception $e) {
        Log::error('Error toggling like: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to process like');
    }
}


    public function showPhoto($id)
    {
        try {
            $photo = Photo::with(['comments' => function($query) {
                $query->with('user');
            }, 'likes', 'shares', 'categories'])
            ->where('photo_id', $id)
            ->firstOrFail();

            $photos = Photo::where('photo_id', '!=', $id)
                ->latest()
                ->get();

            $categories = Category::all();

            $likeCount = $photo->likes->count();
            $shareCount = $photo->shares->count();
            $isLiked = auth()->user()->likes()->where('photo_id', $id)->exists();
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
        } catch (\Exception $e) {
            Log::error('Error showing photo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat foto');
        }
    }

    public function storeComment(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'comment_text' => 'required|string'
            ]);

            Comment::create([
                'photo_id' => $id,
                'user_id' => auth()->id(),
                'comment_text' => $validated['comment_text']
            ]);

            return back()->with('success', 'Komentar berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error storing comment: ' . $e->getMessage());
            return back()->with('error', 'Gagal menambahkan komentar');
        }
    }

    public function deletePhoto($photoId)
    {
        try {
            $photo = Photo::findOrFail($photoId);
            $albumId = $photo->album_id;
            
            // Delete the image file
            Storage::disk('public')->delete($photo->image_path);
            
            $photo->delete();
            
            return redirect()->route('album', $albumId)
                ->with('success', 'Foto telah dipindahkan ke sampah');
        } catch (\Exception $e) {
            Log::error('Error deleting photo: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus foto');
        }
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

            return redirect()->route('album', $album_id)
                ->with('success', 'Album berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating album: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui album: ' . $e->getMessage());
        }
    }

    public function deleteAlbum($album_id)
    {
        try {
            $album = Album::findOrFail($album_id);
            
            // Delete all photos in the album
            foreach ($album->photos as $photo) {
                Storage::disk('public')->delete($photo->image_path);
            }
            $album->photos()->delete();
            
            $album->delete();

            return redirect()->route('profile')
                ->with('success', 'Album berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting album: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus album: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = auth()->user();
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable|string|min:8|confirmed'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ];

            // Handle password update
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Handle profile photo upload
            if ($request->hasFile('profile_photo')) {
                // Delete old photo if exists
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }

                $path = $request->file('profile_photo')->store('profile_photos', 'public');
                $data['profile_photo'] = $path;
            }

            $user->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
