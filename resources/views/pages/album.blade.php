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
                  <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url ?? 'https://flowbite.com/docs/images/people/profile-picture-3.jpg' }}" alt="user photo">  
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
                  <a href="{{ route('welcome') }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>  
              </li>  
              <li>  
                  <a href="{{ route('dashboard') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Photos</a>  
              </li>  
              <li>  
                  <a href="{{route('albumDiscovery')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Discover Albums</a>  
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
                  <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>  
              </li>  
              <li class="md:hidden">  
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" onclick="confirmLogout(event)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
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
        <h2 class="text-3xl font-semibold">Vacation 2023</h2>
        <p class="text-sm text-gray-600 mt-2">A collection of my summer vacation moments!</p>

        <!-- Album Creator Information -->
        <p class="text-sm text-gray-600 mt-2">Created by: <span class="font-semibold text-gray-800">John Doe</span></p>

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
  
    <!-- Edit Album Modal -->
    <div id="editAlbumModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-2/3 md:w-1/2">
            <h2 class="text-xl font-semibold mb-4">Edit Album</h2>
            <div>
                <label for="albumTitle" class="block text-sm text-gray-600">Album Title</label>
                <input type="text" id="albumTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" placeholder="Enter album title" value="Vacation 2023">
            </div>
            <div class="mt-4">
                <label for="albumDescription" class="block text-sm text-gray-600">Album Description</label>
                <textarea id="albumDescription" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" placeholder="Enter album description">A collection of my summer vacation moments!</textarea>
            </div>
            <div class="flex justify-end mt-4 space-x-4">
                <button id="cancelEditAlbum" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                <button id="saveEditAlbum" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Save Changes</button>
            </div>
        </div>
    </div>
  
    <!-- Delete Album Confirmation -->
    <div id="deleteAlbumConfirm" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-2/3 md:w-1/3">
            <h3 class="text-lg font-semibold mb-4">Are you sure you want to delete this album?</h3>
            <div class="flex justify-end space-x-4">
                <button id="cancelDeleteAlbum" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                <button id="confirmDeleteAlbum" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
            </div>
        </div>
    </div>
  
    <!-- Photo Gallery -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
      <!-- Grid of Images -->
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
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
        </a>
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
        </a>
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">
        </a>
      </div>
      <div class="grid gap-4">
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">
        </a>
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">
        </a>
        <a href="{{ route('buka') }}" class="hover:scale-[1.1] hover:shadow-lg duration-300">
          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg" alt="">
        </a>
      </div>
    </div>
  </div>
<!-- Add Font Awesome CDN link in the <head> section of your HTML -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Modal for Adding New Image -->
    <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
      <div class="bg-white p-6 rounded-lg w-2/3 md:w-1/2">
        <h2 class="text-xl font-semibold mb-4">Add New Image</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Left Column: Display Selected Images -->
          <div class="flex justify-center items-center col-span-2 bg-gray-100 border-4 border-dashed border-gray-300 p-6 relative rounded-lg">
            <div class="w-full text-center">
              <input type="file" id="imageFile" class="hidden" accept="image/*" multiple>
              <div id="drop-area" class="p-4 border-2 border-dashed border-blue-600 rounded-lg cursor-pointer">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-600 mb-2"></i>
                <p class="text-gray-600">Drag & Drop your images here or click to browse</p>
              </div>
              
              <!-- Display the images selected by the user -->
              <div id="imagePreviews" class="mt-4 flex flex-wrap gap-4"></div>
            </div>
          </div>
    
          <!-- Right Column: Image Details -->
          <div class="space-y-4">
            <div>
              <label for="imageTitle" class="block text-sm text-gray-600">Image Title</label>
              <input type="text" id="imageTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" placeholder="Enter title">
            </div>
            <div>
              <label for="imageDescription" class="block text-sm text-gray-600">Description</label>
              <textarea id="imageDescription" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" placeholder="Enter description"></textarea>
            </div>
            <!-- Upload Button -->
            <div class="flex justify-end mt-4">
              <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-4">Cancel</button>
              <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Upload</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      // Modal logic
      const openModalButton = document.getElementById('openModal');
      const closeModalButton = document.getElementById('closeModal');
      const modal = document.getElementById('imageModal');
    
      openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
      });
    
      closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
      });
    
      // Deskripsi gambar yang dipilih disimpan dalam objek
      let imageDescriptions = {};
    
      // Drag and Drop logic
      const dropArea = document.getElementById('drop-area');
      const fileInput = document.getElementById('imageFile');
      const imagePreviews = document.getElementById('imagePreviews');
    
      dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropArea.classList.add('bg-gray-200');
      });
    
      dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('bg-gray-200');
      });
    
      dropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dropArea.classList.remove('bg-gray-200');
        handleFiles(event.dataTransfer.files);
      });
    
      dropArea.addEventListener('click', () => {
        fileInput.click();
      });
    
      // Handle file selection
      fileInput.addEventListener('change', (event) => {
        handleFiles(event.target.files);
      });
    
      // Function to handle image files and display previews
      function handleFiles(files) {
        const fileArray = Array.from(files);
        imagePreviews.innerHTML = ''; // Clear previous previews
    
        fileArray.forEach(file => {
          const reader = new FileReader();
    
          reader.onload = function (e) {
            const previewContainer = document.createElement('div');
            previewContainer.classList.add('flex', 'items-center', 'gap-2', 'border', 'p-2', 'rounded-lg', 'bg-gray-100');
            
            const fileName = file.name.split('.')[0]; // Get file name without extension
            const nameElement = document.createElement('span');
            nameElement.classList.add('font-semibold', 'cursor-pointer');
            nameElement.textContent = fileName;
    
            // Create preview image
            const previewImg = document.createElement('img');
            previewImg.src = e.target.result; // Set the preview image source
            previewImg.classList.add('w-24', 'h-24', 'object-cover', 'rounded-lg', 'mb-4', 'hidden'); // Initially hidden
    
            // Add click event to toggle preview image visibility
            nameElement.addEventListener('click', () => {
              // Hide any previously displayed preview images
              const allPreviews = document.querySelectorAll('.preview-img');
              allPreviews.forEach(img => img.classList.add('hidden'));
    
              // Toggle visibility of the clicked image preview
              if (previewImg.classList.contains('hidden')) {
                previewImg.classList.remove('hidden');
              } else {
                previewImg.classList.add('hidden');
              }
    
              // Set image title
              const titleInput = document.getElementById('imageTitle');
              const descriptionInput = document.getElementById('imageDescription');
              titleInput.value = fileName; // Set title to the file name
    
              // Set description from the saved data (if any)
              descriptionInput.value = imageDescriptions[fileName] || ''; // If there's a description, use it, otherwise leave empty
            });
    
            previewContainer.appendChild(nameElement);
            previewContainer.appendChild(previewImg); // Add preview image below name
            imagePreviews.appendChild(previewContainer);
          }
    
          reader.readAsDataURL(file);
        });
      }
    
      // Save description to the imageDescriptions object when the description input changes
      const descriptionInput = document.getElementById('imageDescription');
      descriptionInput.addEventListener('input', () => {
        const titleInput = document.getElementById('imageTitle');
        const imageTitle = titleInput.value;
    
        // Save the description for the image title
        imageDescriptions[imageTitle] = descriptionInput.value;
      });
    </script>
    <script>
        // Modal for Edit Album
        const openEditModal = document.getElementById('editAlbumBtn');
        const editAlbumModal = document.getElementById('editAlbumModal');
        const cancelEditAlbum = document.getElementById('cancelEditAlbum');
        const saveEditAlbum = document.getElementById('saveEditAlbum');
        
        openEditModal.addEventListener('click', () => {
          editAlbumModal.classList.remove('hidden');
        });
      
        cancelEditAlbum.addEventListener('click', () => {
          editAlbumModal.classList.add('hidden');
        });
      
        saveEditAlbum.addEventListener('click', () => {
          const albumTitle = document.getElementById('albumTitle').value;
          const albumDescription = document.getElementById('albumDescription').value;
          alert(`Album Updated!\nTitle: ${albumTitle}\nDescription: ${albumDescription}`);
          editAlbumModal.classList.add('hidden');
        });
      
        // Delete Album Confirmation
        const deleteAlbumBtn = document.getElementById('deleteAlbumBtn');
        const deleteAlbumConfirm = document.getElementById('deleteAlbumConfirm');
        const cancelDeleteAlbum = document.getElementById('cancelDeleteAlbum');
        const confirmDeleteAlbum = document.getElementById('confirmDeleteAlbum');
        
        deleteAlbumBtn.addEventListener('click', () => {
          deleteAlbumConfirm.classList.remove('hidden');
        });
      
        cancelDeleteAlbum.addEventListener('click', () => {
          deleteAlbumConfirm.classList.add('hidden');
        });
      
        confirmDeleteAlbum.addEventListener('click', () => {
          alert("Album Deleted!");
          deleteAlbumConfirm.classList.add('hidden');
        });
      </script>
    
@endsection