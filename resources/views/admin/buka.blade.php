@extends('layouts.apps')

@section('title', 'ArtVista')

@section('content')
<head>
    <style>  
        /* Custom scrollbar styles */  
        .scrollbar-thin::-webkit-scrollbar {  
            width: 8px;  
        }  
        .scrollbar-thumb-\[\#B89263\]::-webkit-scrollbar-thumb {  
            background-color: #B89263;  
            border-radius: 4px;  
        }  
        .scrollbar-track-gray-200::-webkit-scrollbar-track {  
            background-color: #E5E7EB;  
            border-radius: 4px;  
        }  
    </style>  
</head>
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
<section class="bg-gray-500 min-h-[800px] flex items-center justify-center p-4">
    <div class="bg-gray-100 flex flex-col sm:flex-row rounded-2xl shadow-lg max-w-5xl w-full p-5">
        <div class="w-full sm:w-1/2 flex flex-col items-center order-1 sm:order-none relative">
            <!-- Delete Button -->
            <form id="deleteForm-{{ $photo->photo_id }}" action="{{ route('admin.photos.delete', $photo->photo_id) }}" method="POST" class="absolute top-4 right-4">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete({{ $photo->photo_id }})" class="text-white bg-red-500 hover:bg-red-600 p-2 rounded-full transition-transform transform hover:scale-110 shadow-md focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18M9 6v12M15 6v12M5 3h14a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                    </svg>
                </button>
            </form>
            <img class="rounded-2xl w-full h-auto" src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}">
            <div class="mt-4 text-center">
                <h2 class="font-bold text-2xl text-[#B89263]">{{ $photo->title }}</h2>
                <p class="text-sm mt-2 text-gray-600">{{ $photo->description }}</p>
            </div>
        </div>
        <div class="w-full sm:w-1/2 px-8 flex flex-col justify-between order-2 sm:order-none md:mt-[0px] mt-5">
            <div>
                <div class="flex justify-between items-center mb-4">
                    <div class="flex space-x-4">
                        <button class="flex items-center space-x-1 text-gray-600 hover:text-[#B89263]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart">
                                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                            </svg>
                            <span>{{ $photo->likes ?? 0 }}</span>
                        </button>
                        <button class="flex items-center space-x-1 text-gray-600 hover:text-[#B89263]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share2">
                                <circle cx="18" cy="5" r="3"/>
                                <circle cx="6" cy="12" r="3"/>
                                <circle cx="18" cy="19" r="3"/>
                                <line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/>
                                <line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/>
                            </svg>
                            <span>{{ $photo->shares ?? 0 }}</span>
                        </button>
                        <button class="text-gray-600 hover:text-[#B89263]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark">
                                <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="relative">
                            <img
                                src="https://api.dicebear.com/8.x/avataaars/svg?seed=custom"
                                alt="Profile"
                                class="w-10 h-10 rounded-full border-2 border-[#B89263] cursor-pointer hover:scale-110 transition-transform"
                            />
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-1">Deskripsi:</p>
                    <p class="text-sm text-gray-700 mb-2">{{ $photo->description }}</p>
                    <p class="text-sm font-semibold text-gray-600 mb-1">Category:</p>
                    <span class="text-sm font-semibold text-[#B89263] bg-gray-200 px-2 py-1 rounded-full">
                        {{ App\Models\Photo::$categories[$photo->category] ?? $photo->category }}
                    </span>
                </div>
            </div>
            <div class="mt-4 flex flex-col">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-bold text-lg text-[#B89263]">Komentar Pengguna:</h3>
                    <span class="text-sm text-gray-600">({{ $comments->count() }})</span>
                </div>
                <div class="overflow-y-auto md:max-h-[400px] max-h-[250px] pr-2 scrollbar-thin scrollbar-thumb-[#B89263] scrollbar-track-gray-200">
                    <div class="space-y-2">
                        @forelse($comments as $comment)
                            <div class="bg-gray-200 p-2 rounded-lg">
                                <p><strong>{{ $comment->name }}:</strong> {{ $comment->comment_text }}</p>
                            </div>
                        @empty
                            <div class="bg-gray-200 p-2 rounded-lg">
                                <p>Belum ada komentar</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-4">
                <div class="relative flex-grow">
                    <form action="{{ route('admin.comments.store', $photo->photo_id) }}" method="POST">
                        @csrf
                        <input type="text" 
                            name="comment_text" 
                            class="w-full p-2 rounded-full border border-[#B89263] focus:outline-none focus:ring-2 focus:ring-[#B89263] placeholder-gray-400" 
                            placeholder="Tambahkan komentar..." 
                            required>
                        <button type="submit" 
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-[#B89263] text-white rounded-full w-8 h-8 flex items-center justify-center hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function confirmDelete(photoId) {
        Swal.fire({
            title: 'Konfirmasi Penghapusan',
            text: "Apakah anda yakin untuk menghapus foto ini? Foto akan disimpan ke sampah.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm-' + photoId).submit();
            }
        });
    }
</script>
@endsection