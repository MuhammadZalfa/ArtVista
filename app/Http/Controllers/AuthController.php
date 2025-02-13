<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // Tampilkan halaman dengan daftar pengguna
    public function showUsers()
    {
        // Ambil semua pengguna dari tabel 'users'
        $users = User::paginate(10);

        // Kirim data pengguna ke view
        return view('admin.table', compact('users'));
    }
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function profilAdmin()
    {
        return view('admin.profilAdmin');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showAlbumAdmin()
    {
        return view('admin.album');
    }

    public function login(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Cek apakah user dengan email ada di database
        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            // Login dengan guard web (default)
            Auth::login($user); // Menggunakan web guard default
    
            // Redirect sesuai dengan access level
            if ($user->access_level == 'admin') {
                return redirect()->route('admin');
            } else {
                return redirect()->route('welcome');
            }
        }
    
        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    // Halaman admin
    public function admin()
{
    \Log::info('Fetching albums');
    $albums = Album::with(['photos' => function($query) {
        $query->latest()->limit(1); // Get the latest photo for each album
    }])
    ->where('user_id', Auth::id())
    ->withCount('photos')
    ->orderBy('created_at', 'desc')
    ->get();

    \Log::info('Albums count: ' . $albums->count());
    
    $photos = Photo::select('photos.*')
        ->withCount('likes')
        ->with('album')
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('admin.admin', compact('albums', 'photos'));
}
    // Fungsi untuk registrasi
    public function register(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat user baru dengan access_level otomatis menjadi 'user'
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'access_level' => 'user', // Menetapkan 'user' sebagai nilai default untuk access_level
        ]);

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'User successfully registered! Please login.');
    }
    // AuthController.php

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
