@extends('layouts.admin')

@section('title', 'ArtVista')

@section('content')

<nav id="navbar" class="bg-white border-gray-200 dark:bg-gray-900 sticky top-0 z-50 shadow-md">  
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">  
        <a href="{{ route('admin') }}" class="flex items-center space-x-3 rtl:space-x-reverse">  
            <img src="{{asset('images/logo.png')}}" class="h-8" alt="Flowbite Logo" />  
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">ArtVista</span>  
        </a>    
        <div class="flex items-center md:order-2 space-x-3 md:space-x-4 rtl:space-x-reverse">  
            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">  
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">  
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>  
                </svg>  
                <span class="sr-only">Search</span>  
            </button>  
            <div class="relative hidden md:block mr-4">  
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">  
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">  
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>  
                    </svg>  
                </div>  
                <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">  
            </div>  
            
            @auth
            <div class="relative hidden md:block">  
                <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">  
                    <span class="sr-only">Open user menu</span>  
                    @if(Auth::user()->profile_photo)
                        <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="user photo">  
                    @else
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-sm font-bold text-gray-600">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">  
                    <div class="px-4 py-3">  
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>  
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>  
                    </div>  
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>  
                            <a href="{{ route('profileAdmin') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">profile</a>  
                        </li>
                        <li>  
                            <form method="POST" action="{{ route('logout') }}" id="logout-form-desktop">
                                @csrf
                                <a href="#" onclick="confirmLogout(event, 'logout-form-desktop')" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Sign out
                                </a>
                            </form>
                        </li>  
                    </ul>  
                </div>  
            </div>
            @endauth

            @guest
            <div class="hidden md:block">
                <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Login
                </a>
            </div>
            @endguest
            
            <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-search" aria-expanded="false">  
                <span class="sr-only">Open main menu</span>  
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">  
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>  
                </svg>  
            </button>  
        </div>  
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">  
            <div class="relative mt-3 md:hidden">  
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">  
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">  
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>  
                  </svg>  
                </div>  
                <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">  
            </div>  
        
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">  
                <li>  
                    <a href="{{ route('admin') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>  
                </li>  
                <li>  
                    <a href="{{ route('table') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Table User</a>  
                </li>

                @auth
                <li class="md:hidden border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">  
                    <div class="flex items-center px-4 py-2 space-x-3">  
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                                alt="{{ auth()->user()->name }}'s Avatar" 
                                class="w-16 h-16 rounded-full object-cover">
                        @else
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-sm font-bold text-gray-600">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </span>
                        </div>  
                        @endif
                        <div>  
                            <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>  
                            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>  
                        </div>  
                    </div>  
                </li>  
                <li class="md:hidden">  
                    <a href="{{ route('profileAdmin') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">profile</a>  
                </li>  
                <li class="md:hidden">  
                    <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                        @csrf
                        <a href="#" onclick="confirmLogout(event, 'logout-form-mobile')" 
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            Sign out
                        </a>
                    </form>
                </li>
                @endauth

                @guest
                <li class="md:hidden">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        Login
                    </a>
                </li>
                @endguest
            </ul>  
        </div>  
    </div>  
</nav>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="bg-white w-full min-h-screen p-6 rounded-lg shadow-md flex flex-col">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 flex-grow">
        <div class="md:col-span-1 space-y-6">
            <div class="flex items-center space-x-4">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                         alt="{{ auth()->user()->name }}'s Avatar" 
                         class="w-16 h-16 rounded-full object-cover">
                @else
                <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="md:text-2xl sm:text-sm font-bold text-gray-600">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </span>
                </div>  
                @endif
                <div>
                    <h1 class="text-2xl font-bold">{{ auth()->user()->username }}</h1>
                    <p class="text-gray-500 text-sm">Member since {{ auth()->user()->created_at->diffForHumans() }}</p>
                </div>
            </div>
      
            @php
            $userStats = auth()->user()->loadCount(['likes', 'albums', 'photos']);
            @endphp
      
            <div class="bg-gray-100 p-4 rounded-lg">
                <h3 class="text-xl font-semibold">Detail Profil</h3>
                <div class="flex flex-col space-y-4 mt-4">
                    <div>
                        <p class="text-sm text-gray-600">Total Likes</p>
                        <p class="font-semibold">{{ $userStats->likes_count }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Albums</p>
                        <p class="font-semibold">{{ $userStats->albums_count }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Photos</p>
                        <p class="font-semibold">{{ $userStats->photos_count }}</p>
                    </div>
                </div>
            </div>
      
            <div class="mt-4 flex space-x-4">
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg">Share</button>
                <button class="text-gray-600">Edit Profile</button>
            </div>
        </div>
      
        <div class="md:col-span-3 space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">My Albums</h3>
                <button id="openModal" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Tambah Album</button>
            </div>
  
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                @php
                use App\Models\Photo;
                @endphp 
                @forelse($albums as $album)
                    <div class="bg-gray-200 p-4 rounded-lg relative">
                        <a href="{{ route('adminAlbum', $album->album_id) }}">
                            @php
                                $firstPhoto = Photo::where('album_id', $album->album_id)->first();
                            @endphp
                            @if($firstPhoto)
                                <img src="{{ asset('storage/' . $firstPhoto->image_path) }}" 
                                     alt="{{ $album->title }}" 
                                     class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <img src="/api/placeholder/150/150" 
                                     alt="No Photos" 
                                     class="w-full h-48 object-cover rounded-t-lg">
                            @endif
                            <h4 class="font-semibold mt-2">{{ $album->title }}</h4>
                            <p class="text-sm text-gray-600">{{ $album->description }}</p>
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <div class="bg-gray-100 rounded-lg p-6">
                            <p class="text-gray-600 text-lg">Belum ada album yang dibuat</p>
                            <p class="text-gray-500 mt-2">Klik tombol "Tambah Album" untuk membuat album baru</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Modal -->
        <div id="albumModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg w-1/3">
                <h2 class="text-xl font-semibold mb-4">Tambah Album</h2>
                <form id="albumForm">
                    @csrf
                    <div class="mb-4">
                        <label for="albumTitle" class="block text-sm text-gray-600">Nama Album</label>
                        <input type="text" id="albumTitle" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="albumDescription" class="block text-sm text-gray-600">Deskripsi Album</label>
                        <textarea id="albumDescription" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required></textarea>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      <!-- Di bagian head layout -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        // DOM Elements
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const modal = document.getElementById('albumModal');
        const albumForm = document.getElementById('albumForm');
        
        // Open modal handler
        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });
        
        // Close modal handler
        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
            albumForm.reset(); // Reset form when closing
        });
        
        // Close modal if clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                albumForm.reset();
            }
        });
        
        // Escape key to close modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                albumForm.reset();
            }
        });
        
        // Form submission handler
        albumForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Disable submit button to prevent double submission
            const submitButton = albumForm.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            
            try {
                // Get form data
                const formData = new FormData(albumForm);
                
                // Add CSRF token
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                
                // Send request
                const response = await fetch('/admin/album', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });
        
                const data = await response.json();
                
                if (response.ok) {
                    // Success handling
                    modal.classList.add('hidden');
                    albumForm.reset();
                    
                    // Show success message
                    alert('Album berhasil ditambahkan');
                    
                    // Reload page to show new album
                    window.location.reload();
                } else {
                    // Error handling
                    throw new Error(data.message || 'Gagal membuat album');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            } finally {
                // Re-enable submit button
                submitButton.disabled = false;
            }
        });
        
        // Input validation
        const albumTitle = document.getElementById('albumTitle');
        const albumDescription = document.getElementById('albumDescription');
        
        // Real-time validation
        const validateInput = (input, minLength = 3) => {
            const value = input.value.trim();
            
            if (value.length < minLength) {
                input.classList.add('border-red-500');
                return false;
            } else {
                input.classList.remove('border-red-500');
                return true;
            }
        };
        
        albumTitle.addEventListener('input', () => validateInput(albumTitle));
        albumDescription.addEventListener('input', () => validateInput(albumDescription));
        
        // Form validation before submit
        albumForm.addEventListener('submit', (e) => {
            const isTitleValid = validateInput(albumTitle);
            const isDescriptionValid = validateInput(albumDescription);
            
            if (!isTitleValid || !isDescriptionValid) {
                e.preventDefault();
                alert('Mohon isi semua field dengan benar');
            }
        });
        
        // Helper function to show error messages
        const showError = (message) => {
            alert(message);
        };
        
        // Helper function to handle network errors
        const handleNetworkError = (error) => {
            console.error('Network Error:', error);
            showError('Terjadi kesalahan jaringan. Silakan coba lagi.');
        };
        </script>
@endsection