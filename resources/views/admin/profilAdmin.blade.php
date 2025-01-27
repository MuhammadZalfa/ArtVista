@extends('layouts.admin')

@section('title', 'ArtVista')

@section('content')
<nav id="navbar" class="bg-white border-gray-200 dark:bg-gray-900 sticky top-0 z-50 shadow-md">  
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">  
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">  
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />  
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>  
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
                    <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url ?? 'https://flowbite.com/docs/images/people/profile-picture-3.jpg' }}" alt="user photo">  
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
                        <img class="w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url ?? 'https://flowbite.com/docs/images/people/profile-picture-3.jpg' }}" alt="user photo">  
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
<!-- Pastikan Anda sudah menyertakan Font Awesome di dalam <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="bg-white w-full min-h-screen p-6 rounded-lg shadow-md flex flex-col">
      <!-- Grid Layout for Profile and Albums -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 flex-grow">
    
        <!-- Left Side: Profile Section -->
        <div class="md:col-span-1 space-y-6">
          <!-- Avatar and Profile Info -->
          <div class="flex items-center space-x-4">
            @if(auth()->user()->profile_photo)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                     alt="{{ auth()->user()->name }}'s Avatar" 
                     class="w-16 h-16 rounded-full object-cover">
            @else
                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-user-circle text-4xl text-gray-500"></i>
                </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold">{{ auth()->user()->username }}</h1>
                <p class="text-gray-500 text-sm">Member since {{ auth()->user()->created_at->diffForHumans() }}</p>
            </div>
        </div>
    
        <div class="bg-gray-100 p-4 rounded-lg">
          <h3 class="text-xl font-semibold">Detail Profil</h3>
          <div class="flex flex-col space-y-4 mt-4">
              <div>
                  <p class="text-sm text-gray-600">Total Likes</p>
                  <p class="font-semibold">{{ $user->likes_count }}</p>
              </div>
              <div>
                  <p class="text-sm text-gray-600">Total Albums</p>
                  <p class="font-semibold">{{ $user->albums_count }}</p>
              </div>
              <div>
                  <p class="text-sm text-gray-600">Total Photos</p>
                  <p class="font-semibold">{{ $user->photos_count }}</p>
              </div>
          </div>
      </div>
    
          <!-- Action Buttons -->
          <div class="mt-4 flex space-x-4">
            <button class="bg-red-600 text-white px-4 py-2 rounded-lg">Share</button>
            <button class="text-gray-600">Edit Profile</button>
          </div>
        </div>
    
        <!-- Right Side: My Albums Section -->
        <div class="md:col-span-3 space-y-6">
          <!-- Add Album Button -->
          <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold">My Albums</h3>
            <button id="openModal" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Tambah Album</button>
          </div>
    
          <!-- Albums Grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
            <!-- Album 1 -->
            <div class="bg-gray-200 p-4 rounded-lg relative">
              <img src="https://via.placeholder.com/150" alt="Album Thumbnail" class="w-full h-48 object-cover rounded-t-lg" onclick="window.location.href='{{ route('album') }}'">
              <h4 class="font-semibold mt-2">Vacation 2023</h4>
              <p class="text-sm text-gray-600">Photos from my summer vacation</p>
              <!-- Edit and Delete Buttons -->
              <div class="absolute bottom-2 right-2 flex space-x-2">
                <button class="text-yellow-500 p-2 rounded-full">
                  <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="text-red-500 p-2 rounded-full">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
    
            <!-- Album 2 -->
            <div class="bg-gray-200 p-4 rounded-lg relative">
              <img src="https://via.placeholder.com/150" alt="Album Thumbnail" class="w-full h-48 object-cover rounded-t-lg" onclick="window.location.href='{{ route('album') }}'">
              <h4 class="font-semibold mt-2">Family Moments</h4>
              <p class="text-sm text-gray-600">Cherished memories with family</p>
              <!-- Edit and Delete Buttons -->
              <div class="absolute bottom-2 right-2 flex space-x-2">
                <button class="text-yellow-500 p-2 rounded-full">
                  <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="text-red-500 p-2 rounded-full">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
    
            <!-- Album 3 -->
            <div class="bg-gray-200 p-4 rounded-lg relative">
              <img src="https://via.placeholder.com/150" alt="Album Thumbnail" class="w-full h-48 object-cover rounded-t-lg" onclick="window.location.href='{{ route('album') }}'">
              <h4 class="font-semibold mt-2">Nature Photography</h4>
              <p class="text-sm text-gray-600">Exploring the beauty of nature</p>
              <!-- Edit and Delete Buttons -->
              <div class="absolute bottom-2 right-2 flex space-x-2">
                <button class="text-yellow-500 p-2 rounded-full">
                  <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="text-red-500 p-2 rounded-full">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
    
      </div>
    </div>
    
    <!-- Modal for Adding Album -->
    <div id="albumModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
      <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Tambah Album</h2>
        <form>
          <div class="mb-4">
            <label for="albumName" class="block text-sm text-gray-600">Nama Album</label>
            <input type="text" id="albumName" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
          </div>
          <div class="mb-4">
            <label for="albumDescription" class="block text-sm text-gray-600">Deskripsi Album</label>
            <textarea id="albumDescription" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
          </div>
          <div class="flex justify-end space-x-4">
            <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Batal</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
          </div>
        </form>
      </div>
    </div>
    
    <script>
      // Modal logic
      const openModalButton = document.getElementById('openModal');
      const closeModalButton = document.getElementById('closeModal');
      const modal = document.getElementById('albumModal');
    
      openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
      });
    
      closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
      });
    </script>
@endsection