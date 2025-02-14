    <?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\AlbumController;
    use App\Http\Controllers\PenggunaController;
    use App\Http\Controllers\AdminAlbumController;

    // Grouping routes that require authentication
    Route::middleware(['auth'])->group(function () {
        // Admin route accessible only by authenticated users
        Route::get('/admin', [AuthController::class, 'admin'])->name('admin');

        // Show Users Table with Pagination (Admin)
        Route::get('/admin/table', [UserController::class, 'index'])->name('table');

        // Create a new user (Admin)
        Route::post('/admin/user', [UserController::class, 'create'])->name('createUser');

        // Change this route in your routes file
        Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('editUser'); 

        Route::post('/admin/user/update/{id}', [UserController::class, 'update'])->name('updateUser');

        // Delete user (Admin)
        Route::delete('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
        
        // Menjadi ini:
        Route::get('/admin/profile', [AdminAlbumController::class, 'adminIndex'])->name('profileAdmin');

        Route::get('/admin/album/{album_id}', [AdminAlbumController::class, 'showAdminAlbum'])->name('adminAlbum');

        Route::post('/admin/album', [AdminAlbumController::class, 'adminStore'])->name('admin.album.store'); // Tambahkan ini

        Route::put('/admin/album/{album_id}', [AdminAlbumController::class, 'updateAlbum'])->name('admin.album.update');

        Route::delete('/admin/album/{album_id}', [AdminAlbumController::class, 'deleteAlbum'])->name('admin.album.delete');

        Route::post('/admin/photos', [AdminAlbumController::class, 'storePhoto'])->name('admin.photos.store');

        Route::delete('admin/photos/{photo}', [AdminAlbumController::class, 'deletePhoto'])->name('admin.photos.delete');

        Route::put('/admin/photos/{id}', [AdminAlbumController::class, 'updatePhoto'])->name('admin.photos.update');
        // Route untuk fitur like dan share
        Route::post('/admin/photos/{photo}/like', [AdminAlbumController::class, 'toggleLike'])->name('admin.photos.like.toggle');
        
        Route::post('/admin/photos/{photo}/share', [AdminAlbumController::class, 'handleShare'])->name('admin.photos.share');
        
        // Route yang sudah ada untuk photo
        Route::get('/admin/photo/{id}', [AdminAlbumController::class, 'showPhoto'])->name('adminBuka');
        
        Route::post('/admin/photo/{id}/comment', [AdminAlbumController::class, 'storeComment'])->name('admin.comments.store');

    });

// Route for login form (only accessible to guests)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Route for handling login
Route::post('/login', [AuthController::class, 'login']);

// Route for handling logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route for register form (only accessible to guests)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest'); 
 
// Route for handling register submission
Route::post('/register', [AuthController::class, 'register']);


// Route to welcome page for authenticated users
Route::get('/', [PenggunaController::class, 'dashboard'])->name('welcome');

// Non-auth routes (can be accessed by anyone)
Route::get('/photos', [PenggunaController::class, 'PhotoPages'])->name('dashboard');

Route::get('/photos/open/{id}', [PenggunaController::class, 'showPhotos'])->name('buka');

Route::post('/photos/open/{id}/comment', [AlbumController::class, 'storeComment'])->name('user.comments.store');

Route::delete('/photos/open/{photo}', [AlbumController::class, 'deletePhoto'])->name('user.photos.delete');

Route::post('/photos/open/{id}/toggle-like', [AlbumController::class, 'toggleLike'])->name('photos.toggle-like');

Route::get('/profile', [AlbumController::class, 'userIndex'])->name('profile');

Route::put('/profile/update', [AlbumController::class, 'updateProfile'])->name('profile.update');

Route::post('/album', [AlbumController::class, 'storeAlbum'])->name('album.store');

Route::post('/user/photos', [AlbumController::class, 'storePhoto'])->name('user.photos.store');

Route::delete('/user/album/{album_id}', [AlbumController::class, 'deleteAlbum'])->name('user.album.delete');

Route::put('/user/album/{album_id}', [AlbumController::class, 'updateAlbum'])->name('user.album.update');

// User routes (tanpa middleware)
Route::get('/user/album/{album_id}', [AlbumController::class, 'showUserAlbum'])->name('album');

Route::get('/album', [PenggunaController::class, 'albumDiscovery'])->name('albumDiscovery');

