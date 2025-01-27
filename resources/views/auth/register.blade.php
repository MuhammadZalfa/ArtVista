@extends('layouts.apps')  

@section('title', 'Login')  

@section('content')  
<!-- Back Button -->  
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="absolute top-4 left-4">  
    <button class="bg-[#394680] text-white rounded-lg px-4 py-2 hover:scale-110 duration-300" onclick="window.location.href='{{ route('welcome') }}'">  
        Kembali  
    </button>  
</div>  

<section class="bg2-custom min-h-screen flex items-center justify-center">  
    <div class="bg-gray-100 flex flex-col sm:flex-row rounded-2xl shadow-lg max-w-3xl p-5">  
        <!-- Form Section -->
        <div class="sm:w-1/2 px-16 flex flex-col justify-center">
            <h2 class="font-bold text-2xl text-[#394680]">Register</h2>  
            <p class="text-sm mt-4 text-[#394680]">Kalo kamu belom join, ayo join sekarang!</p>  

            <form action="{{ url('/register') }}" method="POST" class="flex flex-col gap-4 mt-8">
                @csrf
                <input class="p-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="name" placeholder="Masukan Nama" required>
                <input class="p-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="username" placeholder="Masukan Username" required>
                <input class="p-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" name="email" placeholder="Masukan Email" required>
                <div class="relative">
                    <input class="p-2 rounded-xl border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password" placeholder="Masukan Password" required>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer" viewBox="0 0 16 16" id="togglePassword">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                </div>
                <input class="p-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                <button class="bg-[#394680] rounded-xl py-2 text-white hover:scale-110 duration-300 mt-4">Register</button>
            </form>
            

            <div class="mt-10 grid grid-cols-3 items-center text-gray-500">  
                <hr class="border-gray-500">  
                <p class="text-center text-sm">OR</p>  
                <hr class="border-gray-500">  
            </div>  

            <!-- Login Button -->
            <button class="bg-white border py-2 w-full rounded-xl mt-5 hover:scale-110 duration-300" onclick="window.location.href='{{ route('login') }}'">  
                Login Sekarang  
            </button>  
        </div>  

        <!-- Image Section -->
        <div class="sm:block hidden w-1/2">  
            <img class="rounded-2xl" src="{{ asset('images/register.jpeg') }}" alt="">  
        </div>  
    </div>  
</section>

<script>
    // Show/Hide Password Toggle
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.querySelector('input[name="password"]');

    togglePassword.addEventListener("click", function() {
        // Toggle password visibility
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;
    });
</script>

@endsection