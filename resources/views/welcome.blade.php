@extends('layouts.welcome') 

@section('title', 'ArtVista')
@section('content')
<!-- Example logout button in your view -->


<head>
    <style>  
        /* Hide all cards except the first one by default */  
        .card {  
            display: none; /* Hide all cards by default */  
        }  
        .card.active {  
            display: block; /* Show the active card */  
        }  
        @media (min-width: 768px) {  
            .card {  
                display: block; /* Show all cards in desktop view */  
            }  
        }  
    </style> 
</head>
<header class="bg-custom flex flex-col justify-center items-center text-center text-white" style="height: auto; min-height: 100vh;">  
    <div class="container mx-auto flex justify-center items-center p-4">  
        <nav class="bg-[#FFB38E] rounded-full px-8 py-2 flex items-center space-x-8 sticky top-0 z-10 md:flex hidden">  
            <span class="text-3xl font-bold text-black font-italiana">ArtVista</span>  
            <a href="{{route('welcome')}}" class="text-black hover:text-white hover:border-b font-francois">Homepage</a>  
            <a href="{{route('dashboard')}}" class="text-black hover:text-white hover:border-b font-francois">Photos</a>  
            <a href="#" class="text-black hover:text-white hover:border-b font-francois">Discover Albums</a>  
            @auth
                <a href="{{ route('profile') }}" class="bg-[#DE8F5F] text-white text-lg px-6 py-2 rounded-full hover:scale-110 duration-300 hover:bg-[#DE8F5F]">Profile</a>
            @else
                <a href="{{ route('login') }}" class="bg-[#DE8F5F] text-white text-lg px-6 py-2 rounded-full hover:scale-110 duration-300 hover:bg-[#DE8F5F]">Login</a>
            @endauth
        </nav>
    </div>
    <!-- Konten Utama -->  
    <div class="flex flex-col justify-center items-center">  
        <h1 class="font-francois text-[30px] md:text-[70px] text-[40px] font-reguler mb-4">ABADIKAN MOMENT <br> BERHARGA MU DI <br> ART VISTA</h1>  
        <input type="text" placeholder="CARI PHOTO ATAU ALBUM" class="px-4 md:px-[150px] py-[10px] rounded-full bg-white text-gray-800 mb-2 w-full max-w-md">   
        <h5 class="font-francois text-[10px] md:text-[20px] text-[16px] font-reguler mb-4">atau <br> <a href="" class="hover:underline">bergabung </a>untuk mengunggah Moment Anda!</h5>  
    </div>  
</header>  

<section class="mt-8">
    <div class="flex flex-wrap justify-center space-x-4">
        @forelse($albums as $album)
            <div class="max-w-xs w-full bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 relative mb-4">
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
                <div class="p-5">
                    <h4 class="font-semibold mt-2 text-xl text-gray-800">{{ $album->title }}</h4>
                    <p class="text-sm text-gray-600">{{ Str::limit($album->description, 30) }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        Created by: <span class="font-semibold text-gray-800">{{ $album->user->username }}</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Total Photos: {{ $album->photos_count }}
                    </p>
                </div>
            </div>
        @empty
            <div class="w-full text-center text-gray-500 py-4">
                Belum ada album. Buat album pertamamu sekarang!
            </div>
        @endforelse
    </div>
</section>


<div id="fotoGrid" class="w-full px-4 py-8">
    @if($photos->count() > 0)
    <div class="columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">
        @foreach($photos as $photo)
        <div class="break-inside-avoid mb-6">
            <a href="{{ route('buka', $photo->photo_id) }}" 
               class="block transform transition-transform duration-300 hover:scale-[1.02] hover:shadow-lg">
                <img class="w-full h-auto rounded-lg object-cover"
                     src="{{ asset('storage/' . $photo->image_path) }}"
                     alt="{{ $photo->title }}"
                     title="{{ $photo->description }}">
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-8">
        <p class="text-gray-500">No photos found</p>
    </div>
    @endif
</div>

<script>
    function editAlbum(albumId) {
        // Implement edit album logic
        window.location.href = `/admin/album/${albumId}/edit`;
    }

    function deleteAlbum(albumId) {
        if(confirm('Apakah Anda yakin ingin menghapus album ini?')) {
            // Implement delete album logic
            fetch(`/admin/album/${albumId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if(response.ok) {
                    window.location.reload();
                }
            });
        }
    }
</script>
@endsection
