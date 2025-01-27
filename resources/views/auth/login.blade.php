@extends('layouts.apps')  

@section('title', 'Login')  

@section('content')  
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registration Successful',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6',
        });
    </script>
@endif
@if (session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
        {{ session('error') }}
    </div>
@endif


<div class="absolute top-4 left-4">  
    <button class="bg-[#B89263] text-white rounded-lg px-4 py-2 hover:scale-110 duration-300" onclick="window.location.href='{{ route('welcome') }}'">  
        Kembali  
    </button>  
</div>  

<section class="bg2-custom min-h-screen flex items-center justify-center">  
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5">  
        <div class="sm:w-1/2 px-16">  
            <h2 class="font-bold text-2xl text-[#B89263]">Login</h2>  
            <p class="text-sm mt-4 text-[#B89263]">Kalo kamu sudah join kami, tinggal login sajah!</p>  

            <form action="{{ url('/login') }}" method="POST" class="flex flex-col gap-4">
                @csrf  <!-- CSRF Token untuk keamanan -->
            
                <!-- Email Field -->
                <input class="p-2 mt-8 rounded-xl border" type="email" name="email" placeholder="Masukan Email" required>
            
                <!-- Password Field -->
                <div class="relative">
                    <input class="p-2 rounded-xl border w-full" type="password" name="password" placeholder="Masukan Password" required>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                </div>
            
                <!-- Error Handling -->
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <!-- Login Button -->
                <button class="bg-[#B89263] rounded-xl py-2 text-white hover:scale-110 duration-300">Log In</button>
            </form>
            
            

            <div class="mt-10 grid grid-cols-3 items-center text-gray-500">  
                <hr class="border-gray-500">  
                <p class="text-center text-sm">OR</p>  
                <hr class="border-gray-500">  
            </div>  

            <button class="bg-white border py-2 w-full rounded-xl mt-5 hover:scale-110 duration-300" onclick="window.location.href='{{ route('register') }}'">  
                Join Akun Sekarang!  
            </button>  

        </div>  
        <div class="sm:block hidden w-1/2">  
            <img class="rounded-2xl" src="{{asset('images/login.jpeg')}}" alt="">  
        </div>  
    </div>  
</section>  
@endsection