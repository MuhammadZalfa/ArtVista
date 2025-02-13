<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.25/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.25/dist/sweetalert2.min.css" rel="stylesheet">
    <style>  
        .font-italiana {  
            font-family: 'Italiana', serif;  
        }  
        .font-francois {
            font-family: 'Jacques Francois', serif;
        }
        .bg-custom {
            background-image: url('{{ asset('images/bg.png') }}'); /* Gambar background */
            background-size: cover; /* Menutupi seluruh area header */
            background-position: center; /* Menjaga posisi gambar tetap di tengah */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            height: auto; /* Tinggi akan menyesuaikan isi konten */
            min-height: 100vh;
        }
        .bg2-custom {
            background-image: url('{{ asset('images/bg2.png') }}'); /* Gambar background */
            background-size: cover; /* Menutupi seluruh area header */
            background-position: center; /* Menjaga posisi gambar tetap di tengah */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            height: auto; /* Tinggi akan menyesuaikan isi konten */
            min-height: 100vh;
        }
        body {
            margin: 0;
            padding: 0;
        }
    </style>  
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Header -->
    <div class="main">
        @yield('content')
    </div>

    <script>
        // Alert Templates
const showLogoutConfirm = () => {
    return Swal.fire({
        title: 'Konfirmasi Logout',
        text: 'Apakah Anda yakin ingin keluar?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, keluar!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        background: '#ffffff',
        iconColor: '#f59e0b',
        customClass: {
            confirmButton: 'swal2-confirm bg-red-500 hover:bg-red-600',
            cancelButton: 'swal2-cancel bg-gray-500 hover:bg-gray-600'
        }
    });
};

const showLogoutSuccess = () => {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Logout',
        text: 'Anda telah berhasil keluar dari sistem',
        showConfirmButton: false,
        timer: 1500,
        position: 'top-end',
        toast: true
    });
};

const showSessionTimeout = () => {
    Swal.fire({
        icon: 'warning',
        title: 'Sesi Berakhir',
        text: 'Sesi Anda telah berakhir. Silakan login kembali.',
        confirmButtonColor: '#3b82f6',
        confirmButtonText: 'Login Kembali'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/login';
        }
    });
};

const showError = (message) => {
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: message || 'Terjadi kesalahan. Silakan coba lagi.',
        confirmButtonColor: '#ef4444'
    });
};

// Main Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Logout Handler
    function confirmLogout(event) {
        event.preventDefault();
        
        showLogoutConfirm().then((result) => {
            if (result.isConfirmed) {
                const form = event.target.closest('form');
                if (form) {
                    // Show loading state
                    Swal.fire({
                        title: 'Logging out...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit the form
                    form.submit();
                }
            }
        });
    }

    // Search Functionality
    const searchInputs = document.querySelectorAll('#search-navbar');
    searchInputs.forEach(input => {
        let debounceTimer;

        input.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const searchTerm = this.value.trim();
                if (searchTerm.length >= 2) {
                    performSearch(searchTerm);
                }
            }, 500);
        });
    });

    async function performSearch(term) {
        try {
            const response = await fetch(`/search?q=${encodeURIComponent(term)}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error('Search failed');
            }

            const data = await response.json();
            // Handle search results here
            
        } catch (error) {
            console.error('Search error:', error);
            showError('Gagal melakukan pencarian. Silakan coba lagi.');
        }
    }

    // Mobile Menu Toggle
    const mobileMenuButton = document.querySelector('[data-collapse-toggle="navbar-search"]');
    const mobileMenu = document.getElementById('navbar-search');

    mobileMenuButton?.addEventListener('click', () => {
        mobileMenu?.classList.toggle('hidden');
    });

    // User Dropdown Toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    userMenuButton?.addEventListener('click', () => {
        userDropdown?.classList.toggle('hidden');
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (userDropdown && !userDropdown.contains(e.target) && 
            !userMenuButton?.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });

    // Session Timeout Handler
    let sessionTimeout;
    const SESSION_DURATION = 30 * 60 * 1000; // 30 minutes

    function resetSessionTimer() {
        clearTimeout(sessionTimeout);
        sessionTimeout = setTimeout(() => {
            showSessionTimeout();
        }, SESSION_DURATION);
    }

    // Reset timer on user activity
    ['mousedown', 'keydown', 'scroll', 'touchstart'].forEach(event => {
        document.addEventListener(event, resetSessionTimer, { passive: true });
    });

    // Initialize session timer
    resetSessionTimer();

    // Expose logout function globally
    window.confirmLogout = confirmLogout;
});

// Network Error Handler
window.addEventListener('offline', () => {
    Swal.fire({
        icon: 'warning',
        title: 'Koneksi Terputus',
        text: 'Koneksi internet Anda terputus. Beberapa fitur mungkin tidak tersedia.',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
});

window.addEventListener('online', () => {
    Swal.fire({
        icon: 'success',
        title: 'Koneksi Pulih',
        text: 'Koneksi internet Anda telah pulih.',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500
    });
});     
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
