@extends('layouts.apps')

@section('title', 'ArtVista')

@section('content')
<style>
    select[multiple] {
        min-height: 120px;
        padding: 8px;
    }
    
    select[multiple] option {
        padding: 8px;
        margin: 2px 0;
        border-radius: 4px;
    }
    
    select[multiple] option:checked {
        background: #3b82f6 linear-gradient(0deg, #3b82f6 0%, #3b82f6 100%);
        color: white;
    }

    .pill {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        margin: 0.25rem;
        background-color: #e5e7eb;
        color: #374151;
        border-radius: 9999px;
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .remove-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 0.5rem;
        padding: 0.125rem 0.375rem;
        background-color: transparent;
        border: none;
        color: #6b7280;
        cursor: pointer;
        font-size: 1rem;
        line-height: 1;
        border-radius: 9999px;
    }

    .remove-pill:hover {
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.1);
    }
</style>
<nav id="navbar" class="bg-white border-gray-200 dark:bg-gray-900 sticky top-0 z-50 shadow-md">  
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">  
      <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">  
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
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                            alt="{{ auth()->user()->name }}'s Avatar" 
                            class="w-8 h-8 rounded-full object-cover">
                    @else
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="md:text-2xl sm:text-sm font-bold text-gray-600">
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
                          <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>  
                      </li>
                      <li>  
                        <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a href="{{ route('logout') }}" onclick="confirmLogout(event)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
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
                  <a href="{{ route('welcome') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>  
              </li>  
              <li>  
                  <a href="{{ route('dashboard') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Photos</a>  
              </li>  
              <li>  
                  <a href="{{route('albumDiscovery')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Discover Albums</a>  
              </li> 

              @auth
              <li class="md:hidden border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">  
                  <div class="flex items-center px-4 py-2 space-x-3">  
                    @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                        alt="{{ auth()->user()->name }}'s Avatar" 
                        class="w-8 h-8 rounded-full object-cover">
                    @else
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="md:text-2xl sm:text-sm font-bold text-gray-600">
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
                  <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>  
              </li>  
              <li class="md:hidden">  
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                  @csrf
                  <button type="submit" onclick="confirmLogout(event)" 
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white w-full text-left">
                      Sign out
                  </button>
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
<div class="bg-white w-full min-h-screen p-4 sm:p-6 rounded-lg shadow-md flex flex-col">
    <!-- Album Header -->
    <div class="mb-4 sm:mb-6">
        <div class="flex flex-col sm:flex-row justify-between">
            <!-- Album Info Column -->
            <div class="flex-1 max-w-[calc(100%-160px)]">
                <h2 class="text-2xl sm:text-3xl font-semibold">{{ $album->title }}</h2>
                <div class="mt-1 sm:mt-2">
                    <p class="text-xs sm:text-sm text-gray-600 break-words">{{ $album->description }}</p>
                </div>
                
                <!-- Album Creator Information -->
                <p class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2">
                    Created by: <span class="font-semibold text-gray-800">{{ $album->user->name }}</span>
                </p>
            </div>
    
            <!-- Buttons Column -->
            <div class="mt-4 sm:mt-0 sm:ml-6 flex flex-col space-y-2 min-w-[140px]">
                
                @if(auth()->check() && auth()->id() === $album->user_id)
                <button class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm w-full" id="openModal">
                    <i class="fas fa-plus mr-1"></i> Add New Image
                </button>
                <button class="bg-yellow-500 text-white px-3 py-2 rounded-lg text-sm w-full" id="editAlbumBtn">
                    <i class="fas fa-pencil-alt mr-1"></i> Edit Album
                </button>
                <button class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm w-full" id="deleteAlbumBtn">
                    <i class="fas fa-trash mr-1"></i> Delete Album
                </button>
                @endif
            </div>
        </div>
    </div>
  
    @if($photos->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 mt-4 sm:mt-8">
        @foreach($photos as $photo)
        <div class="relative group">
            <a href="{{ route('buka', $photo->photo_id) }}" 
               class="block overflow-hidden rounded-lg transition-all duration-300 
                      hover:scale-[1.02] hover:shadow-lg hover:z-10">
                <img class="w-full h-auto object-cover rounded-lg"
                     src="{{ asset('storage/' . $photo->image_path) }}"
                     alt="{{ $photo->title }}"
                     title="{{ $photo->description }}">
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="flex flex-col items-center justify-center py-8 sm:py-12">
        <div class="bg-gray-100 rounded-lg p-6 sm:p-8 text-center max-w-md w-full">
            <i class="fas fa-images text-3xl sm:text-4xl text-gray-400 mb-3 sm:mb-4"></i>
            <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-2">Belum Ada Foto</h3>
            <p class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6">
                Album ini masih kosong. Mulai tambahkan foto dengan mengklik tombol "Add New Image".
            </p>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm sm:text-base" id="openModalEmpty">
                <i class="fas fa-plus mr-2"></i> Add New Image
            </button>
        </div>
    </div>
    @endif
  </div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden p-4 z-[60]">
    <div class="bg-white rounded-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto mt-16">
        <div class="p-4 sm:p-6">
              <h2 class="text-xl font-semibold mb-4">Add New Image</h2>
              
              @if(session('success'))
                  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                      {{ session('success') }}
                  </div>
              @endif
  
              @if(session('error'))
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                      {{ session('error') }}
                  </div>
              @endif
  
              <form action="{{ route('user.photos.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="album_id" value="{{ $album->album_id }}">
                  
                  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                      <!-- Image Upload Area -->
                      <div class="lg:col-span-2 flex justify-center items-center bg-gray-100 border-4 border-dashed border-gray-300 p-4 sm:p-6 relative rounded-lg min-h-[200px]">
                          <div class="w-full text-center">
                              <div id="drop-area" class="p-4 border-2 border-dashed border-blue-600 rounded-lg cursor-pointer">
                                  <div id="preview-container" class="hidden">
                                      <img id="preview-image" class="max-h-48 mx-auto object-contain" src="" alt="Preview">
                                  </div>
                                  <div id="upload-prompt">
                                      <i class="fas fa-cloud-upload-alt text-4xl text-gray-600 mb-2"></i>
                                      <p class="text-gray-600">Click to upload image</p>
                                  </div>
                                  <input type="file" name="image" id="image-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" required>
                              </div>
                              @error('image')
                                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                              @enderror
                          </div>
                      </div>
              
                      <!-- Image Details -->
                      <div class="space-y-4">
                          <div>
                              <label for="imageTitle" class="block text-sm text-gray-600">Image Title</label>
                              <input type="text" name="title" id="imageTitle" 
                                  class="w-full px-3 py-1.5 border border-gray-300 rounded-lg mt-1 text-sm @error('title') border-red-500 @enderror" 
                                  placeholder="Enter title" value="{{ old('title') }}" required>
                              @error('title')
                                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                              @enderror
                          </div>
                          
                          <div>
                              <label for="imageDescription" class="block text-sm text-gray-600">Description</label>
                              <textarea name="description" id="imageDescription" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-1 @error('description') border-red-500 @enderror" 
                                  placeholder="Enter description" rows="4">{{ old('description') }}</textarea>
                              @error('description')
                                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                              @enderror
                          </div>
  
                          <!-- Category Dropdown -->
                          <div>
                              <label for="category" class="block text-sm text-gray-600">Categories</label>
                              <select name="category[]" id="category" 
                                  class="w-full px-3 py-1.5 border border-gray-300 rounded-lg mt-1 text-sm" multiple>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                  @endforeach
                              </select>
                              <div id="selected-categories" class="mt-2 flex flex-wrap gap-2"></div>
                              @error('category')
                                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                              @enderror
                              
                              <p class="text-sm text-gray-500 mt-1">
                                  Tahan tombol CTRL (Windows) atau CMD (Mac) untuk memilih beberapa kategori
                              </p>
                          </div>
              
                          <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-4 mt-6">
                              <button type="button" id="closeModal" 
                                  class="w-full sm:w-auto bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                              <button type="submit" 
                                  class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg">Upload</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
<!-- Modal Edit Album -->
<div id="editAlbumModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden overflow-y-auto">
    <div class="bg-white p-4 sm:p-6 rounded-lg w-11/12 sm:w-3/4 md:w-1/2 max-w-xl mx-4 my-8">
      <h2 class="text-lg sm:text-xl font-semibold mb-4">Edit Album</h2>
      <form id="editAlbumForm" action="{{ route('user.album.update', $album->album_id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
          <label for="editAlbumTitle" class="block text-sm text-gray-600 mb-1">Album Title</label>
          <input type="text" name="title" id="editAlbumTitle" 
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg" 
                 value="{{ $album->title }}" required>
        </div>
        <div>
          <label for="editAlbumDescription" class="block text-sm text-gray-600 mb-1">Description</label>
          <textarea name="description" id="editAlbumDescription" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg" 
                    rows="4" required>{{ $album->description }}</textarea>
        </div>
        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
          <button type="button" id="closeEditAlbumModal" 
                  class="w-full sm:w-auto bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
            Cancel
          </button>
          <button type="submit" 
                  class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            Update Album
          </button>
        </div>
      </form>
    </div>
  </div>

<!-- Modal Delete Album -->
<div id="deleteAlbumModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white p-6 rounded-lg w-1/2">
      <h2 class="text-xl font-semibold mb-4 text-red-600">Delete Album</h2>
      <p class="text-gray-600 mb-6">Are you sure you want to delete this album? All photos in this album will also be deleted.</p>
      <form id="deleteAlbumForm" action="{{ route('user.album.delete', $album->album_id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="flex justify-end space-x-4">
              <button type="button" id="closeDeleteAlbumModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
              <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg">Delete Album</button>
          </div>
      </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sweet Alert Templates
    const sweetAlerts = {
        // Success Alerts
        addPhotoSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Foto Berhasil Ditambahkan',
                text: 'Foto baru telah ditambahkan ke album',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#ffffff',
                iconColor: '#10b981'
            });
        },

        editAlbumSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Album Berhasil Diperbarui',
                text: 'Data album telah berhasil diperbarui',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#ffffff',
                iconColor: '#10b981'
            });
        },

        deleteAlbumSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Album Berhasil Dihapus',
                text: 'Album dan semua fotonya telah dihapus',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#ffffff',
                iconColor: '#10b981'
            });
        },

        // New method for photo deletion success
        deletePhotoSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Foto Berhasil Dihapus',
                text: 'Foto telah dipindahkan ke sampah',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#ffffff',
                iconColor: '#10b981'
            });
        },

        // Confirmation Alerts
        confirmDeleteAlbum: () => {
            return Swal.fire({
                title: 'Hapus Album?',
                text: "Semua foto dalam album ini akan terhapus. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true,
                background: '#ffffff',
                iconColor: '#f59e0b',
                showClass: {
                    popup: 'animate__animated animate__fadeIn'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOut'
                }
            });
        },

        confirmDiscard: () => {
            return Swal.fire({
                title: 'Batalkan Perubahan?',
                text: "Perubahan yang belum disimpan akan hilang!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Lanjutkan Edit',
                reverseButtons: true,
                background: '#ffffff',
                iconColor: '#6b7280'
            });
        },

        // Error Alerts
        showError: (message) => {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: message || 'Terjadi kesalahan. Silakan coba lagi.',
                confirmButtonColor: '#ef4444',
                background: '#ffffff',
                iconColor: '#ef4444'
            });
        },

        // Validation Alerts
        showValidationError: (message) => {
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                text: message || 'Mohon isi semua field yang diperlukan',
                confirmButtonColor: '#f59e0b',
                background: '#ffffff',
                iconColor: '#f59e0b'
            });
        },

        // Loading Alerts
        showLoading: (message) => {
            Swal.fire({
                title: message || 'Memproses...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                },
                background: '#ffffff'
            });
        },

        // Upload Progress Alert
        showUploadProgress: () => {
            let timerInterval;
            Swal.fire({
                title: 'Mengunggah Foto',
                html: 'Mohon tunggu sebentar...',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    timerInterval = setInterval(() => {
                        const content = Swal.getHtmlContainer();
                        if (content) {
                            const b = content.querySelector('b');
                            if (b) {
                                b.textContent = Swal.getTimerLeft();
                            }
                        }
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
        }
    };

    // DOM Elements for Modals
    const imageModal = document.getElementById('imageModal');
    const editAlbumModal = document.getElementById('editAlbumModal');
    const deleteAlbumModal = document.getElementById('deleteAlbumModal');
    const editAlbumBtn = document.getElementById('editAlbumBtn');
    const deleteAlbumBtn = document.getElementById('deleteAlbumBtn');
    const closeEditAlbumModal = document.getElementById('closeEditAlbumModal');
    const closeDeleteAlbumModal = document.getElementById('closeDeleteAlbumModal');

    // DOM Elements for Image Upload
    const openModalButton = document.getElementById('openModal');
    const openModalEmptyButton = document.getElementById('openModalEmpty');
    const closeModalButton = document.getElementById('closeModal');
    const imageInput = document.getElementById('image-input');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const uploadPrompt = document.getElementById('upload-prompt');
    const categorySelect = document.getElementById('category');

    // Modal Functions
    function showImageModal() {
        if (imageModal) imageModal.classList.remove('hidden');
    }

    function hideImageModal() {
        if (imageModal) {
            imageModal.classList.add('hidden');
            if (previewContainer) previewContainer.classList.add('hidden');
            if (uploadPrompt) uploadPrompt.classList.remove('hidden');
            if (previewImage) previewImage.src = '';
            // Reset form if exists
            const form = imageModal.querySelector('form');
            if (form) form.reset();
        }
    }

    function showEditAlbumModal() {
        if (editAlbumModal) editAlbumModal.classList.remove('hidden');
    }

    function hideEditAlbumModal() {
        if (editAlbumModal) editAlbumModal.classList.add('hidden');
    }

    function showDeleteAlbumModal() {
        if (deleteAlbumModal) deleteAlbumModal.classList.remove('hidden');
    }

    function hideDeleteAlbumModal() {
        if (deleteAlbumModal) deleteAlbumModal.classList.add('hidden');
    }

    // Event Listeners for Image Modal
    if (openModalButton) {
        openModalButton.addEventListener('click', showImageModal);
    }

    if (openModalEmptyButton) {
        openModalEmptyButton.addEventListener('click', showImageModal);
    }

    if (closeModalButton) {
        closeModalButton.addEventListener('click', async () => {
            const form = imageModal.querySelector('form');
            if (form && form.dataset.modified) {
                const result = await sweetAlerts.confirmDiscard();
                if (result.isConfirmed) {
                    hideImageModal();
                }
            } else {
                hideImageModal();
            }
        });
    }

    // Event Listeners for Edit Album Modal
    if (editAlbumBtn) {
        editAlbumBtn.addEventListener('click', showEditAlbumModal);
    }

    if (closeEditAlbumModal) {
        closeEditAlbumModal.addEventListener('click', async () => {
            const form = editAlbumModal.querySelector('form');
            if (form && form.dataset.modified) {
                const result = await sweetAlerts.confirmDiscard();
                if (result.isConfirmed) {
                    hideEditAlbumModal();
                }
            } else {
                hideEditAlbumModal();
            }
        });
    }

    // Event Listeners for Delete Album Modal
    if (deleteAlbumBtn) {
        deleteAlbumBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            const result = await sweetAlerts.confirmDeleteAlbum();
            if (result.isConfirmed) {
                sweetAlerts.showLoading('Menghapus album...');
                document.getElementById('deleteAlbumForm').submit();
            }
        });
    }

    if (closeDeleteAlbumModal) {
        closeDeleteAlbumModal.addEventListener('click', hideDeleteAlbumModal);
    }

    // Close modals when clicking outside
    window.onclick = function(e) {
        if (e.target === imageModal) hideImageModal();
        if (e.target === editAlbumModal) hideEditAlbumModal();
        if (e.target === deleteAlbumModal) hideDeleteAlbumModal();
    }

    // Track form modifications
    document.querySelectorAll('form').forEach(form => {
        form.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('change', () => {
                form.dataset.modified = 'true';
            });
        });
    });

    async function compressImage(file) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        const reader = new FileReader();

        reader.onload = function(e) {
            img.src = e.target.result;
        };

        img.onload = function() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            let width = img.width;
            let height = img.height;
            const maxWidth = 1920;
            const maxHeight = 1080;

            if (width > height) {
                if (width > maxWidth) {
                    height = Math.round((height * maxWidth) / width);
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width = Math.round((width * maxHeight) / height);
                    height = maxHeight;
                }
            }

            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(img, 0, 0, width, height);

            canvas.toBlob((blob) => {
                if (!blob) {
                    reject(new Error('Canvas to Blob conversion failed'));
                    return;
                }

                const compressedFile = new File([blob], file.name, {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                });

                resolve(compressedFile);
            }, 'image/jpeg', 0.7);
        };

        img.onerror = function() {
            reject(new Error('Failed to load image'));
        };

        reader.readAsDataURL(file);
    });
}

// Show file size in human readable format
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Modify the image input handler to include compression with confirmation
if (imageInput) {
    imageInput.addEventListener('change', async function() {
        const file = this.files[0];
        if (!file) return;

        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            sweetAlerts.showValidationError('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
            this.value = '';
            return;
        }

        let processedFile = file;
        
        // Check if file size is greater than 5MB
        if (file.size > 5 * 1024 * 1024) {
            // Show confirmation dialog
            const result = await Swal.fire({
                title: 'Gambar Terlalu Besar',
                html: `Ukuran file: ${formatFileSize(file.size)}<br>
                      File akan dikompresi secara otomatis.<br><br>
                      Apakah Anda ingin melanjutkan?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kompres',
                cancelButtonText: 'Batal',
                reverseButtons: true
            });

            if (result.isConfirmed) {
                try {
                    sweetAlerts.showLoading('Mengompres gambar...');
                    processedFile = await compressImage(file);
                    
                    // If still too large after compression
                    if (processedFile.size > 5 * 1024 * 1024) {
                        sweetAlerts.showValidationError(`Ukuran file masih terlalu besar setelah kompresi (${formatFileSize(processedFile.size)}). Silakan gunakan gambar yang lebih kecil.`);
                        this.value = '';
                        return;
                    }

                    // Show success message with size comparison
                    Swal.fire({
                        icon: 'success',
                        title: 'Kompresi Berhasil',
                        html: `Ukuran awal: ${formatFileSize(file.size)}<br>
                               Ukuran akhir: ${formatFileSize(processedFile.size)}<br>
                               Pengurangan: ${Math.round((1 - processedFile.size/file.size) * 100)}%`,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    // Create a new FileList with the compressed file
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(processedFile);
                    this.files = dataTransfer.files;

                } catch (error) {
                    sweetAlerts.showError('Gagal mengompres gambar: ' + error.message);
                    this.value = '';
                    return;
                }
            } else {
                // User cancelled compression
                this.value = '';
                return;
            }
        }

        // Preview the processed image
        const reader = new FileReader();
        reader.onload = function(e) {
            if (previewImage) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadPrompt.classList.add('hidden');
            }
            
            // Auto-fill title from filename
            const imageTitle = document.getElementById('imageTitle');
            if (imageTitle && !imageTitle.value) {
                imageTitle.value = processedFile.name.replace(/\.[^/.]+$/, "");
            }
        }
        reader.readAsDataURL(processedFile);
    });
}

    // Category Pills Handler
    if (categorySelect) {
        const selectedCategoriesContainer = document.getElementById('selected-categories');
        
        function renderPills() {
            if (!selectedCategoriesContainer) return;
            
            selectedCategoriesContainer.innerHTML = '';
            Array.from(categorySelect.selectedOptions).forEach(option => {
                const pill = document.createElement('span');
                pill.classList.add('pill');
                pill.textContent = option.text;
                pill.id = 'pill-' + option.value;

                const removeButton = document.createElement('button');
                removeButton.textContent = '×';
                removeButton.classList.add('remove-pill');
                removeButton.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    option.selected = false;
                    renderPills();
                };

                pill.appendChild(removeButton);
                selectedCategoriesContainer.appendChild(pill);
            });
        }

        categorySelect.addEventListener('change', renderPills);
        renderPills(); // Initial render
    }

    // Form Submissions
    const photoForm = document.querySelector('form[enctype="multipart/form-data"]');
    if (photoForm) {
        photoForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validate required fields
            const title = this.querySelector('#imageTitle')?.value.trim();
            const image = this.querySelector('#image-input')?.files[0];
            
            if (!title || !image) {
                sweetAlerts.showValidationError('Mohon isi judul dan pilih foto');
                return;
            }

            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) submitButton.disabled = true;
            
            sweetAlerts.showUploadProgress();

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this)
                });

                if (response.ok) {
                    hideImageModal();
                    sweetAlerts.addPhotoSuccess();
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    const data = await response.json();
                    throw new Error(data.message || 'Gagal mengunggah foto');
                }
            } catch (error) {
                sweetAlerts.showError(error.message);
            } finally {
                if (submitButton) submitButton.disabled = false;
            }
        });
    }

    const editAlbumForm = document.getElementById('editAlbumForm');
    if (editAlbumForm) {
        editAlbumForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validate required fields
            const title = this.querySelector('input[name="title"]')?.value.trim();
            const description = this.querySelector('textarea[name="description"]')?.value.trim();
            
            if (!title || !description) {
                sweetAlerts.showValidationError('Mohon isi semua field yang diperlukan');
                return;
            }

            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) submitButton.disabled = true;
            
            sweetAlerts.showLoading('Memperbarui album...');

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this)
                });

                if (response.ok) {
                    hideEditAlbumModal();
                    sweetAlerts.editAlbumSuccess();
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    const data = await response.json();
                    throw new Error(data.message || 'Gagal memperbarui album');
                }
            } catch (error) {
                sweetAlerts.showError(error.message);
            } finally {
                if (submitButton) submitButton.disabled = false;
            }
        });
    }

    // File drag and drop handling
    const dropArea = document.getElementById('drop-area');
    if (dropArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropArea.classList.add('border-blue-500', 'bg-blue-50');
        }

        function unhighlight(e) {
            dropArea.classList.remove('border-blue-500', 'bg-blue-50');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                handleFiles(files);
            }
        }

        function handleFiles(files) {
            const file = files[0]; // Handle only the first file
            if (file && imageInput) {
                // Create a new FileList containing only the dropped file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                imageInput.files = dataTransfer.files;
                
                // Trigger change event
                imageInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }
    }

    // Check for session messages and display corresponding alerts
    @if(session('success'))
        sweetAlerts.deletePhotoSuccess();
    @endif

    @if(session('error'))
        sweetAlerts.showError('{{ session('error') }}');
    @endif
});
</script>   
    
@endsection