@extends('layouts.apps')

@section('title', 'ArtVista')

@section('content')
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
                  <a href="{{route('albumDiscovery')}}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Discover Albums</a>  
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
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4 p-4">
    @foreach($albums as $album)
    <div class="bg-gray-200 p-4 rounded-lg relative">
        @if($album->photos()->whereNull('deleted_at')->first())
            <img 
                src="{{ asset('storage/' . $album->photos()->whereNull('deleted_at')->first()->image_path) }}" 
                alt="Album Thumbnail" 
                class="w-full h-48 object-cover rounded-t-lg" 
                onclick="window.location.href='{{ route('album', $album->album_id) }}'"
            >
        @else
            <div 
                class="w-full h-48 bg-gray-300 rounded-t-lg flex items-center justify-center cursor-pointer"
                onclick="window.location.href='{{ route('album', $album->album_id) }}'"
            >
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
        <h4 class="font-semibold mt-2">{{ $album->title }}</h4>
        <p class="text-sm text-gray-600">{{ Str::limit($album->description, 30) }}</p>
        <p class="text-xs text-gray-500">Created by: <span class="font-semibold text-gray-800">{{ $album->user->name }}</span></p>
        
        <!-- Photo Count Badge -->
        <div class="absolute top-2 right-2 bg-gray-800 text-white text-xs px-2 py-1 rounded-full">
            {{ $album->photos_count }} photos
        </div>
    </div>
    @endforeach
</div>

@endsection