@extends('layouts.admin')

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
        <a href="{{ route('admin') }}" class="flex items-center space-x-3 rtl:space-x-reverse">  
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
<div class="bg-white w-full min-h-screen p-6 rounded-lg shadow-md flex flex-col">
    <!-- Album Header -->
    <div class="mb-6">
        <h2 class="text-3xl font-semibold">{{ $album->title }}</h2>
        <p class="text-sm text-gray-600 mt-2">{{ $album->description }}</p>

        <!-- Album Creator Information -->
        <p class="text-sm text-gray-600 mt-2">Created by: <span class="font-semibold text-gray-800">{{ $album->user->name }}</span></p>

        <div class="flex justify-end space-x-4 mt-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg" id="openModal">
                <i class="fas fa-plus"></i> Add New Image
            </button>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg" id="editAlbumBtn">
                <i class="fas fa-pencil-alt"></i> Edit Album
            </button>
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg" id="deleteAlbumBtn">
                <i class="fas fa-trash"></i> Delete Album
            </button>
        </div>
    </div>
    @if($photos->count() > 0)
    <div class="columns-2 md:columns-3 lg:columns-4 gap-3 mt-8">
        @foreach($photos as $photo)
        <div class="break-inside-avoid mb-3">
            <a href="{{ route('adminBuka', $photo->photo_id) }}" class="block hover:scale-[1.02] hover:shadow-lg duration-300">
                <img class="w-full h-auto rounded-lg"
                     src="{{ asset('storage/' . $photo->image_path) }}"
                     alt="{{ $photo->title }}"
                     title="{{ $photo->description }}">
            </a>
        </div>
    @endforeach
    </div>
    @else

    <div class="flex flex-col items-center justify-center py-12">
        <div class="bg-gray-100 rounded-lg p-8 text-center max-w-md">
            <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Foto</h3>
            <p class="text-gray-500 mb-6">Album ini masih kosong. Mulai tambahkan foto dengan mengklik tombol "Add New Image".</p>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700" id="openModalEmpty">
                <i class="fas fa-plus mr-2"></i> Add New Image
            </button>
        </div>
    </div>
@endif
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-4/5">
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

        <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="album_id" value="{{ $album->album_id }}">
            
            <div class="grid grid-cols-3 gap-6">
                <!-- Image Upload Area -->
                <div class="col-span-2 flex justify-center items-center bg-gray-100 border-4 border-dashed border-gray-300 p-6 relative rounded-lg h-full">
                    <div class="w-full text-center">
                        <div id="drop-area" class="p-4 border-2 border-dashed border-blue-600 rounded-lg cursor-pointer">
                            <div id="preview-container" class="hidden">
                                <img id="preview-image" class="max-h-48 mx-auto" src="" alt="Preview">
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
                    <div class="mb-4">
                        <label for="imageTitle" class="block text-sm text-gray-600">Image Title</label>
                        <input type="text" name="title" id="imageTitle" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg mt-1 text-sm @error('title') border-red-500 @enderror" placeholder="Enter title" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="imageDescription" class="block text-sm text-gray-600">Description</label>
                        <textarea name="description" id="imageDescription" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2 @error('description') border-red-500 @enderror" placeholder="Enter description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
        <!-- Category Dropdown -->
                <div class="mb-4">
                    <label for="category" class="block text-sm text-gray-600">Categories</label>
                    <select name="category[]" id="category" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg mt-1 text-sm" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div id="selected-categories" class="mt-2"></div>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Tambahkan helper text -->
                    <p class="text-sm text-gray-500 mt-1">
                        Tahan tombol CTRL (Windows) atau CMD (Mac) untuk memilih beberapa kategori
                    </p>
                </div>
        
                    <div class="flex justify-end mt-4">
                        <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-4">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Upload</button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>
<!-- Modal Edit Album -->
<div id="editAlbumModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="text-xl font-semibold mb-4">Edit Album</h2>
        <form id="editAlbumForm" action="{{ route('admin.album.update', $album->album_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="editAlbumTitle" class="block text-sm text-gray-600">Album Title</label>
                <input type="text" name="title" id="editAlbumTitle" 
                       class="w-full px-3 py-1.5 border border-gray-300 rounded-lg mt-1" 
                       value="{{ $album->title }}" required>
            </div>
            <div class="mb-4">
                <label for="editAlbumDescription" class="block text-sm text-gray-600">Description</label>
                <textarea name="description" id="editAlbumDescription" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" 
                          rows="4" required>{{ $album->description }}</textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" id="closeEditAlbumModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Update Album</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Delete Album -->
<div id="deleteAlbumModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="text-xl font-semibold mb-4 text-red-600">Delete Album</h2>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this album? All photos in this album will also be deleted.</p>
        <form id="deleteAlbumForm" action="{{ route('admin.album.delete', $album->album_id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="button" id="closeDeleteAlbumModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg">Delete Album</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Album Edit dan Delete Modal Handler
document.addEventListener('DOMContentLoaded', function() {
    const editAlbumModal = document.getElementById('editAlbumModal');
    const deleteAlbumModal = document.getElementById('deleteAlbumModal');
    const editAlbumBtn = document.getElementById('editAlbumBtn');
    const deleteAlbumBtn = document.getElementById('deleteAlbumBtn');
    
    const closeEditAlbumModal = document.getElementById('closeEditAlbumModal');
    const closeDeleteAlbumModal = document.getElementById('closeDeleteAlbumModal');

    // Edit Album Modal
    function showEditAlbumModal() {
        editAlbumModal.classList.remove('hidden');
    }

    function hideEditAlbumModal() {
        editAlbumModal.classList.add('hidden');
    }

    // Delete Album Modal
    function showDeleteAlbumModal() {
        deleteAlbumModal.classList.remove('hidden');
    }

    function hideDeleteAlbumModal() {
        deleteAlbumModal.classList.add('hidden');
    }

    // Event Listeners
    if (editAlbumBtn) {
        editAlbumBtn.addEventListener('click', showEditAlbumModal);
    }
    if (deleteAlbumBtn) {
        deleteAlbumBtn.addEventListener('click', showDeleteAlbumModal);
    }

    if (closeEditAlbumModal) {
        closeEditAlbumModal.addEventListener('click', hideEditAlbumModal);
    }
    if (closeDeleteAlbumModal) {
        closeDeleteAlbumModal.addEventListener('click', hideDeleteAlbumModal);
    }

    // Close modal when clicking outside
    editAlbumModal.addEventListener('click', function(e) {
        if (e.target === editAlbumModal) {
            hideEditAlbumModal();
        }
    });

    deleteAlbumModal.addEventListener('click', function(e) {
        if (e.target === deleteAlbumModal) {
            hideDeleteAlbumModal();
        }
    });
});
        document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('category');
    let selectedCategoriesContainer = document.getElementById('selected-categories');
    
    // Create the container if it doesn't exist
    if (!selectedCategoriesContainer) {
        selectedCategoriesContainer = document.createElement('div');
        selectedCategoriesContainer.id = 'selected-categories';
        selectElement.parentNode.insertBefore(selectedCategoriesContainer, selectElement.nextSibling);
    }
    
    // Function to render the selected categories as pills
    function renderPills() {
        // Clear existing pills first
        selectedCategoriesContainer.innerHTML = '';
        
        const selectedOptions = Array.from(selectElement.selectedOptions);

        // Loop through selected options and create pills
        selectedOptions.forEach(option => {
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

    // Event listener for when user selects or unselects options
    selectElement.addEventListener('change', renderPills);

    // Initial render in case there are already selected categories
    renderPills();
});
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    const openModalButton = document.getElementById('openModal');
    const openModalEmptyButton = document.getElementById('openModalEmpty');
    const closeModalButton = document.getElementById('closeModal');
    const imageInput = document.getElementById('image-input');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const uploadPrompt = document.getElementById('upload-prompt');

    function showModal() {
        modal.classList.remove('hidden');
    }

    function hideModal() {
        modal.classList.add('hidden');
        // Reset form dan preview saat modal ditutup
        previewContainer.classList.add('hidden');
        uploadPrompt.classList.remove('hidden');
        previewImage.src = '';
    }

    // Preview image handler
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadPrompt.classList.add('hidden');
                
                // Set judul otomatis dari nama file jika field judul kosong
                const imageTitle = document.getElementById('imageTitle');
                if (!imageTitle.value) {
                    imageTitle.value = file.name.replace(/\.[^/.]+$/, ""); // Hapus ekstensi file
                }
            }
            reader.readAsDataURL(file);
        }
    });

    if (openModalButton) {
        openModalButton.addEventListener('click', showModal);
    }
    if (openModalEmptyButton) {
        openModalEmptyButton.addEventListener('click', showModal);
    }
    if (closeModalButton) {
        closeModalButton.addEventListener('click', hideModal);
    }

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideModal();
        }
    });
});
</script>
@endsection