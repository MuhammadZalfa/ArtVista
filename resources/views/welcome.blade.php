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
            <a href="{{ route('login') }}" class="bg-[#DE8F5F] text-white text-lg px-6 py-2 rounded-full hover:scale-110 duration-300 hover:bg-[#DE8F5F]">Login</a>  
        </nav>
    </div>  
    <!-- Konten Utama -->  
    <div class="flex flex-col justify-center items-center">  
        <h1 class="font-francois text-[30px] md:text-[70px] text-[40px] font-reguler mb-4">ABADIKAN MOMENT <br> BERHARGA MU DI <br> ART VISTA</h1>  
        <input type="text" placeholder="CARI PHOTO ATAU ALBUM" class="px-4 md:px-[150px] py-[10px] rounded-full bg-white text-gray-800 mb-2 w-full max-w-md">   
        <h5 class="font-francois text-[10px] md:text-[20px] text-[16px] font-reguler mb-4">atau <br> <a href="" class="hover:underline">bergabung </a>untuk mengunggah Moment Anda!</h5>  
    </div>  
</header>  

<!-- Add margin here to create space between sections -->  
<!-- Add margin here to create space between sections -->  
<section class="mt-8">
    <div class="flex flex-wrap justify-center space-x-4">
        <!-- Album 1 -->
        <div class="max-w-xs w-full bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 relative">
            <img src="https://via.placeholder.com/150" alt="Album Thumbnail" class="w-full h-48 object-cover rounded-t-lg" onclick="window.location.href='{{ route('album') }}'">
            <div class="p-5">
                <h4 class="font-semibold mt-2 text-xl text-gray-800">Vacation 2023</h4>
                <p class="text-sm text-gray-600">Photos from my summer vacation</p>
                <p class="text-xs text-gray-500 mt-2">Created by: <span class="font-semibold text-gray-800">John Doe</span></p> <!-- Creator Info -->
            </div>
            <!-- Edit and Delete Buttons -->
            <div class="absolute bottom-2 right-2 flex space-x-2">
                <button class="text-yellow-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="text-red-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <!-- Album 2 -->
        <div class="max-w-xs w-full bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 relative">
            <img src="https://via.placeholder.com/150" alt="Album Thumbnail" class="w-full h-48 object-cover rounded-t-lg" onclick="window.location.href='{{ route('album') }}'">
            <div class="p-5">
                <h4 class="font-semibold mt-2 text-xl text-gray-800">Family Moments</h4>
                <p class="text-sm text-gray-600">Cherished memories with family</p>
                <p class="text-xs text-gray-500 mt-2">Created by: <span class="font-semibold text-gray-800">Jane Smith</span></p> <!-- Creator Info -->
            </div>
            <!-- Edit and Delete Buttons -->
            <div class="absolute bottom-2 right-2 flex space-x-2">
                <button class="text-yellow-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="text-red-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <!-- Album 3 -->
        <div class="max-w-xs w-full bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 relative">
            <img src="https://via.placeholder.com/150" alt="Album Thumbnail" class="w-full h-48 object-cover rounded-t-lg" onclick="window.location.href='{{ route('album') }}'">
            <div class="p-5">
                <h4 class="font-semibold mt-2 text-xl text-gray-800">Nature Photography</h4>
                <p class="text-sm text-gray-600">Exploring the beauty of nature</p>
                <p class="text-xs text-gray-500 mt-2">Created by: <span class="font-semibold text-gray-800">Chris Johnson</span></p> <!-- Creator Info -->
            </div>
            <!-- Edit and Delete Buttons -->
            <div class="absolute bottom-2 right-2 flex space-x-2">
                <button class="text-yellow-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="text-red-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <!-- Album 4 -->
        <div class="max-w-xs w-full bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 relative">
            <img src="https://via.placeholder.com/150" alt="Album Thumbnail" class="w-full h-48 object-cover rounded-t-lg" onclick="window.location.href='{{ route('album') }}'">
            <div class="p-5">
                <h4 class="font-semibold mt-2 text-xl text-gray-800">City Lights</h4>
                <p class="text-sm text-gray-600">Exploring the city's vibrant nightlife</p>
                <p class="text-xs text-gray-500 mt-2">Created by: <span class="font-semibold text-gray-800">Alice Brown</span></p> <!-- Creator Info -->
            </div>
            <!-- Edit and Delete Buttons -->
            <div class="absolute bottom-2 right-2 flex space-x-2">
                <button class="text-yellow-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="text-red-500 p-2 rounded-full bg-white shadow-lg hover:bg-gray-200">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="flex justify-center mt-6">
        <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px">
                <li>
                    <button id="prevBtn" class="px-3 py-2 ml-0 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" aria-label="Previous" onclick="changeCard(-1)">
                        <span aria-hidden="true">&laquo;</span>
                    </button>
                </li>
                <li>
                    <button id="page1" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="showCard(0)">1</button>
                </li>
                <li>
                    <button id="page2" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="showCard(1)">2</button>
                </li>
                <li>
                    <button id="page3" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" onclick="showCard(2)">3</button>
                </li>
                <li>
                    <button id="nextBtn" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" aria-label="Next" onclick="changeCard(1)">
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</section>


<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8"> <!-- Add margin here as well -->  
    <div class="grid gap-4">  
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">  
        </a>  
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">  
        </a>  
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">  
        </a>  
    </div>  
    <div class="grid gap-4">  
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">  
        </a>  
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">  
        </a>  
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg" alt="">  
        </a>  
    </div>  
    <div class="grid gap-4">  
        <a href="{{route('buka')}}" class="hover:scale-[1.1] hover:shadow-lg duration-300" >  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">  
        </a>  
        <a href="{{route('buka')}}" class="hover:scale-[1.1] hover:shadow-lg duration-300" >  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">  
        </a>  
        <a href="{{route('buka')}}" class="hover:scale-[1.1] hover:shadow-lg duration-300" >  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">  
        </a>  
    </div>  
    <div class="grid gap-4">  
        <a href="{{route('buka')}}" class="hover:scale-[1.1] hover:shadow-lg duration-300" >  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">  
        </a>  
        <a href="{{route('buka')}}" class="hover:scale-[1.1] hover:shadow-lg duration-300" >  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">  
        </a>  
        <a href="{{route('buka')}}" class="hover:scale-[1.1] hover:shadow-lg duration-300" >  
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg" alt="">  
        </a>  
    </div>  
    <!-- Lanjutkan pola ini untuk semua elemen gambar lainnya -->
</div>

<script>  
    let currentCardIndex = 0;  
    const cards = document.querySelectorAll('.card');  

    function showCard(index) {  
        cards.forEach((card, i) => {  
            card.classList.remove('active');  
            if (i === index) {  
                card.classList.add('active');  
            }  
        });  
        currentCardIndex = index;  
    }  

    function changeCard(direction) {  
        const newIndex = currentCardIndex + direction;  
        if (newIndex >= 0 && newIndex < cards.length) {  
            showCard(newIndex);  
        }  
    }  

    // Initialize the first card  
    showCard(currentCardIndex);  
</script>  
@endsection
