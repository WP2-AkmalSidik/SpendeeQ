@extends('layouts.app')

@section('title', 'Kategori')

@section('header-action')
<a href="#" id="show-create-form" class="text-white">
    <i class="fa-solid fa-plus text-lg"></i>
</a>
@endsection

@section('content')
    <div class="page-content block" id="page-category">
        <!-- Header -->
        <div class="navy-blue text-white p-6 rounded-b-3xl shadow-lg">
            <div class="flex items-center space-x-4">
                <a href="/" class="text-white">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-xl font-bold text-center">Kategori</h1>
                <button id="show-create-form" class="text-white">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-4 p-4">
            <!-- Total Categories -->
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-2">
                        <i class="fas fa-tag text-blue-500"></i>
                    </div>
                    <h3 class="text-sm font-medium">Total Kategori</h3>
                </div>
                <p class="text-2xl font-bold">8</p>
            </div>

            <!-- Top Category -->
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center mr-2">
                        <i class="fas fa-crown text-purple-500"></i>
                    </div>
                    <h3 class="text-sm font-medium">Terbanyak</h3>
                </div>
                <p class="text-md font-bold">Makanan</p>
                <p class="text-sm text-gray-600">45% dari total</p>
            </div>
        </div>

        <!-- Categories list -->
        <div class="bg-white rounded-xl shadow overflow-hidden mx-4 mb-6">
            <div class="px-4 py-3 bg-gray-50 border-b">
                <h3 class="font-medium">Daftar Kategori</h3>
            </div>

            <div class="divide-y">
                <!-- Category 1 -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 mr-3">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div>
                                <h4 class="font-medium">Makanan</h4>
                                <p class="text-sm text-gray-500">42 transaksi</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold mr-3">Rp 2.450.000</p>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-500 mr-3">
                                <i class="fas fa-car"></i>
                            </div>
                            <div>
                                <h4 class="font-medium">Transportasi</h4>
                                <p class="text-sm text-gray-500">28 transaksi</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold mr-3">Rp 1.250.000</p>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-500 mr-3">
                                <i class="fas fa-cart-shopping"></i>
                            </div>
                            <div>
                                <h4 class="font-medium">Belanja</h4>
                                <p class="text-sm text-gray-500">18 transaksi</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold mr-3">Rp 850.000</p>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-500 mr-3">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <div>
                                <h4 class="font-medium">Tagihan</h4>
                                <p class="text-sm text-gray-500">12 transaksi</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <p class="font-semibold mr-3">Rp 1.780.000</p>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Category Form (Hidden by default) -->
        <div id="create-category-form" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Tambah Kategori Baru</h3>
                        <button id="close-create-form" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="category-form">
                        <!-- Category Name -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                            <input type="text" name="category_name" placeholder="Contoh: Kesehatan, Hobi, dll"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Icon Selection -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Ikon</label>
                            <div class="grid grid-cols-5 gap-3 mt-2">
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="utensils">
                                    <i class="fas fa-utensils text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="car">
                                    <i class="fas fa-car text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="shopping-cart">
                                    <i class="fas fa-shopping-cart text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="file-invoice">
                                    <i class="fas fa-file-invoice text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="heart">
                                    <i class="fas fa-heart text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="home">
                                    <i class="fas fa-home text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="bus">
                                    <i class="fas fa-bus text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="film">
                                    <i class="fas fa-film text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="book">
                                    <i class="fas fa-book text-gray-600"></i>
                                </button>
                                <button type="button" class="icon-option p-3 rounded-lg border border-gray-200 text-center hover:bg-blue-50" data-icon="gamepad">
                                    <i class="fas fa-gamepad text-gray-600"></i>
                                </button>
                            </div>
                            <input type="hidden" name="category_icon" id="selected-icon">
                        </div>

                        <!-- Color Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Warna</label>
                            <div class="flex space-x-3 mt-2">
                                <button type="button" class="color-option w-8 h-8 rounded-full bg-blue-500 border-2 border-transparent hover:border-blue-700" data-color="blue"></button>
                                <button type="button" class="color-option w-8 h-8 rounded-full bg-red-500 border-2 border-transparent hover:border-red-700" data-color="red"></button>
                                <button type="button" class="color-option w-8 h-8 rounded-full bg-green-500 border-2 border-transparent hover:border-green-700" data-color="green"></button>
                                <button type="button" class="color-option w-8 h-8 rounded-full bg-purple-500 border-2 border-transparent hover:border-purple-700" data-color="purple"></button>
                                <button type="button" class="color-option w-8 h-8 rounded-full bg-yellow-500 border-2 border-transparent hover:border-yellow-700" data-color="yellow"></button>
                                <button type="button" class="color-option w-8 h-8 rounded-full bg-pink-500 border-2 border-transparent hover:border-pink-700" data-color="pink"></button>
                            </div>
                            <input type="hidden" name="category_color" id="selected-color">
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 mt-6">
                            <button type="submit"
                                class="flex-1 navy-blue text-white font-medium py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                                Simpan
                            </button>
                            <button type="button" id="cancel-create-form"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showFormBtn = document.getElementById('show-create-form');
            const closeFormBtn = document.getElementById('close-create-form');
            const cancelFormBtn = document.getElementById('cancel-create-form');
            const createForm = document.getElementById('create-category-form');
            const categoryForm = document.getElementById('category-form');
            const iconOptions = document.querySelectorAll('.icon-option');
            const colorOptions = document.querySelectorAll('.color-option');
            const selectedIconInput = document.getElementById('selected-icon');
            const selectedColorInput = document.getElementById('selected-color');

            // Show create form
            showFormBtn.addEventListener('click', function(e) {
                e.preventDefault();
                createForm.classList.remove('hidden');
            });

            // Close create form
            function closeForm() {
                createForm.classList.add('hidden');
                categoryForm.reset();
                selectedIconInput.value = '';
                selectedColorInput.value = '';

                // Reset selected icon and color
                document.querySelectorAll('.icon-option, .color-option').forEach(option => {
                    option.classList.remove('border-blue-500', 'border-2');
                });
            }

            closeFormBtn.addEventListener('click', closeForm);
            cancelFormBtn.addEventListener('click', closeForm);

            // Icon selection
            iconOptions.forEach(option => {
                option.addEventListener('click', function() {
                    iconOptions.forEach(opt => opt.classList.remove('border-blue-500', 'border-2'));
                    this.classList.add('border-blue-500', 'border-2');
                    selectedIconInput.value = this.getAttribute('data-icon');
                });
            });

            // Color selection
            colorOptions.forEach(option => {
                option.addEventListener('click', function() {
                    colorOptions.forEach(opt => opt.classList.remove('border-gray-800', 'border-2'));
                    this.classList.add('border-gray-800', 'border-2');
                    selectedColorInput.value = this.getAttribute('data-color');
                });
            });

            // Form submission
            categoryForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Here you would typically send the form data to your backend
                const formData = new FormData(this);
                console.log('Form data:', Object.fromEntries(formData));

                // Show success message
                alert('Kategori berhasil ditambahkan!');

                // Close the form
                closeForm();

                // In a real app, you would refresh the category list here
            });
        });
    </script>
@endsection
