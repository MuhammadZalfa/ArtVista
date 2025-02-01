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
                    <a href="{{ route('admin') }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>  
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
<div class="container mx-auto px-4 py-8">  
    <!-- Header -->  
    <div class="flex justify-between items-center mb-8">  
        <h1 class="text-3xl font-bold text-gray-800">Gallery Admin</h1>  
    </div>  

    <!-- Navigation Tabs -->  
    <div class="flex border-b mb-6">
        <button id="fotoTab" class="px-4 py-2 border-b-2 border-blue-600 text-blue-600">
            Foto
        </button>
        <button id="albumTab" class="px-4 py-2 text-gray-500">
            Album
        </button>
    </div>
    <div id="fotoGrid" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
        <div class="grid gap-4">
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Beautiful Sunset</h3>
                        <p class="text-white">Likes: 150</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Mountain View</h3>
                        <p class="text-white">Likes: 220</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">City Lights</h3>
                        <p class="text-white">Likes: 180</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="grid gap-4">
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Lake Reflection</h3>
                        <p class="text-white">Likes: 300</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Desert Sand</h3>
                        <p class="text-white">Likes: 120</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Forest Path</h3>
                        <p class="text-white">Likes: 75</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="grid gap-4">
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Golden Hour</h3>
                        <p class="text-white">Likes: 250</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Ocean Breeze</h3>
                        <p class="text-white">Likes: 190</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Winter Wonderland</h3>
                        <p class="text-white">Likes: 130</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="grid gap-4">
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Autumn Leaves</h3>
                        <p class="text-white">Likes: 160</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Desert Mirage</h3>
                        <p class="text-white">Likes: 280</p>
                    </div>
                </div>
            </a>
            <a href="" class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg" alt="">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    <div class="flex justify-between absolute bottom-4 left-4 right-4">
                        <h3 class="text-xl font-semibold text-white">Starry Night</h3>
                        <p class="text-white">Likes: 310</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    <!-- Modify the albumGrid div to be hidden by default -->
    <div id="albumGrid" class="hidden space-y-6">
    
        <!-- Albums Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
            <!-- Album 1 -->
            <div class="bg-gray-200 p-4 rounded-lg relative">
                <img src="https://via.placeholder.com/150" alt="Album Thumbnail" 
                    class="w-full h-48 object-cover rounded-t-lg cursor-pointer hover:opacity-90 transition-opacity"
                    onclick="window.location.href='{{ route('album') }}'">
                <h4 class="font-semibold mt-2">Vacation 2023</h4>
                <p class="text-sm text-gray-600 mb-10">Photos from my summer vacation</p>
                <!-- Edit and Delete Buttons -->
                <div class="absolute bottom-2 right-2 flex space-x-2">
                    <button class="text-yellow-500 p-2 rounded-full hover:bg-gray-300 transition-colors">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="text-red-500 p-2 rounded-full hover:bg-gray-300 transition-colors">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
    
            <!-- Album 2 -->
            <div class="bg-gray-200 p-4 rounded-lg relative">
                <img src="https://via.placeholder.com/150" alt="Album Thumbnail" 
                    class="w-full h-48 object-cover rounded-t-lg cursor-pointer hover:opacity-90 transition-opacity"
                    onclick="window.location.href='{{ route('album') }}'">
                <h4 class="font-semibold mt-2">Family Moments</h4>
                <p class="text-sm text-gray-600 mb-10">Cherished memories with family</p>
                <!-- Edit and Delete Buttons -->
                <div class="absolute bottom-2 right-2 flex space-x-2">
                    <button class="text-yellow-500 p-2 rounded-full hover:bg-gray-300 transition-colors">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="text-red-500 p-2 rounded-full hover:bg-gray-300 transition-colors">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
    
            <!-- Album 3 -->
            <div class="bg-gray-200 p-4 rounded-lg relative">
                <img src="https://via.placeholder.com/150" alt="Album Thumbnail" 
                    class="w-full h-48 object-cover rounded-t-lg cursor-pointer hover:opacity-90 transition-opacity"
                    onclick="window.location.href='{{ route('album') }}'">
                <h4 class="font-semibold mt-2">Nature Photography</h4>
                <p class="text-sm text-gray-600 mb-10">Exploring the beauty of nature</p>
                <!-- Edit and Delete Buttons -->
                <div class="absolute bottom-2 right-2 flex space-x-2">
                    <button class="text-yellow-500 p-2 rounded-full hover:bg-gray-300 transition-colors">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="text-red-500 p-2 rounded-full hover:bg-gray-300 transition-colors">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>  
    document.addEventListener('DOMContentLoaded', function() {
    const albumTab = document.getElementById('albumTab');
    const fotoTab = document.getElementById('fotoTab');
    const fotoGrid = document.getElementById('fotoGrid');
    const albumGrid = document.getElementById('albumGrid');

    // Initially hide album grid and show foto grid
    albumGrid.classList.add('hidden');
    fotoGrid.classList.remove('hidden');

    albumTab.addEventListener('click', function() {
        // Update tab styles
        fotoTab.classList.remove('border-b-2', 'border-blue-600', 'text-blue-600');
        fotoTab.classList.add('text-gray-500');
        albumTab.classList.remove('text-gray-500');
        albumTab.classList.add('border-b-2', 'border-blue-600', 'text-blue-600');
        
        // Show album grid, hide foto grid
        fotoGrid.classList.add('hidden');
        albumGrid.classList.remove('hidden');
    });

    fotoTab.addEventListener('click', function() {
        // Update tab styles
        albumTab.classList.remove('border-b-2', 'border-blue-600', 'text-blue-600');
        albumTab.classList.add('text-gray-500');
        fotoTab.classList.remove('text-gray-500');
        fotoTab.classList.add('border-b-2', 'border-blue-600', 'text-blue-600');
        
        // Hide album grid, show foto grid
        albumGrid.classList.add('hidden');
        fotoGrid.classList.remove('hidden');
    });

    // Initially set foto tab as active
    fotoTab.click();
});
</script>

@endsection