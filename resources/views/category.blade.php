@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="page-content block" id="page-category">
        <!-- Header -->
        <div class="bg-blue-900 text-white px-4 py-3 rounded-b-2xl shadow-md relative">
            <div class="flex items-center justify-between">
                <a href="{{ url()->previous() }}" class="text-white text-lg">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-base font-semibold text-center flex-grow">Kategori</h1>
                <button id="show-create-form" class="text-white text-lg">
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
                <p class="text-2xl font-bold">{{ $totalCategories }}</p>
            </div>

            <!-- Top Category -->
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center mr-2">
                        <i class="fas fa-crown text-purple-500"></i>
                    </div>
                    <h3 class="text-sm font-medium">Terbanyak</h3>
                </div>
                @if ($topCategory)
                    <p class="text-md font-bold">{{ $topCategory->name }}</p>
                    <p class="text-sm text-gray-600">{{ $topCategoryPercentage }}% dari total</p>
                @else
                    <p class="text-md font-bold">-</p>
                    <p class="text-sm text-gray-600">Belum ada data</p>
                @endif
            </div>
        </div>

        <!-- Categories list -->
        <div class="bg-white rounded-xl shadow overflow-hidden mx-4 mb-6">
            <div class="px-4 py-3 bg-gray-50 border-b">
                <h3 class="font-medium">Daftar Kategori</h3>
            </div>

            <div class="divide-y" id="categories-list">
                @foreach ($categories as $category)
                    <div class="p-4 hover:bg-gray-50 transition-colors category-item" data-id="{{ $category->id }}">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 bg-{{ $category->color }}-100"
                                    style="background-color: {{ $category->color }}50; color: {{ $category->color }}">
                                    <i class="fas fa-{{ $category->icon }}"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">{{ $category->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $category->expenses_count }} transaksi</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                @if (isset($category->expenses[0]->total_amount))
                                    <p class="font-semibold mr-3">Rp
                                        {{ number_format($category->expenses[0]->total_amount) }}</p>
                                @else
                                    <p class="font-semibold mr-3">Rp 0</p>
                                @endif
                                <div class="flex space-x-2">
                                    <button class="edit-category text-blue-400 hover:text-blue-600"
                                        data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                        data-icon="{{ $category->icon }}" data-color="{{ $category->color }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @if ($category->user_id)
                                        <!-- Hanya tampilkan delete untuk kategori user -->
                                        <button class="delete-category text-red-400 hover:text-red-600"
                                            data-id="{{ $category->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Create/Edit Category Form Modal -->
        <div id="category-form-modal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold" id="form-title">Tambah Kategori Baru</h3>
                        <button id="close-form" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="category-form">
                        <input type="hidden" id="category-id" name="id">

                        <!-- Category Name -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                            <input type="text" name="name" id="category-name"
                                placeholder="Contoh: Kesehatan, Hobi, dll"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Updated Icon Selection HTML -->
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Ikon</label>
                            <div class="grid grid-cols-5 gap-3 mt-2" id="icon-options">
                                @foreach (['utensils', 'car', 'shopping-cart', 'file-invoice', 'heart', 'home', 'bus', 'film', 'book', 'gamepad'] as $icon)
                                    <button type="button"
                                        class="icon-option p-3 rounded-lg border-2 border-gray-200 text-center hover:bg-blue-50 transition-all"
                                        data-icon="{{ $icon }}">
                                        <i class="fas fa-{{ $icon }} text-gray-600"></i>
                                        <span class="icon-check hidden absolute top-0 right-0 text-blue-500">
                                            <i class="fas fa-check-circle text-xs"></i>
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="icon" id="selected-icon">
                        </div>

                        <!-- Updated Color Selection HTML -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Warna</label>
                            <div class="flex space-x-3 mt-2" id="color-options">
                                @foreach (['blue', 'red', 'green', 'purple', 'yellow', 'pink'] as $color)
                                    <button type="button"
                                        class="color-option w-10 h-10 rounded-full relative bg-{{ $color }}-500 hover:scale-105 transition-all"
                                        data-color="{{ $color }}">
                                        <!-- Checkmark indicator for selected color -->
                                        <span
                                            class="selected-check hidden absolute inset-0 flex items-center justify-center text-white">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="color" id="selected-color">
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 mt-6">
                            <button type="submit" id="submit-btn"
                                class="flex-1 navy-blue text-white font-medium py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                                Simpan
                            </button>
                            <button type="button" id="cancel-form"
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
            // Modal Elements
            const showFormBtn = document.getElementById('show-create-form');
            const closeFormBtn = document.getElementById('close-form');
            const cancelFormBtn = document.getElementById('cancel-form');
            const formModal = document.getElementById('category-form-modal');
            const categoryForm = document.getElementById('category-form');
            const formTitle = document.getElementById('form-title');
            const submitBtn = document.getElementById('submit-btn');
            const categoryIdInput = document.getElementById('category-id');

            // Show create form
            showFormBtn.addEventListener('click', function(e) {
                e.preventDefault();
                formTitle.textContent = 'Tambah Kategori Baru';
                submitBtn.textContent = 'Simpan';
                categoryForm.reset();
                categoryIdInput.value = '';
                formModal.classList.remove('hidden');
            });

            // Close form
            function closeForm() {
                formModal.classList.add('hidden');
                categoryForm.reset();
            }

            closeFormBtn.addEventListener('click', closeForm);
            cancelFormBtn.addEventListener('click', closeForm);

            // Improved icon selection script
            document.querySelectorAll('.icon-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Reset all icon options to default state
                    document.querySelectorAll('.icon-option').forEach(opt => {
                        opt.classList.remove('border-blue-500', 'bg-blue-100',
                            'selected-icon');
                        opt.querySelector('i').classList.remove('text-blue-700');
                        opt.querySelector('i').classList.add('text-gray-600');
                    });

                    // Apply selected styling
                    this.classList.add('border-blue-500', 'bg-blue-100', 'selected-icon');
                    this.querySelector('i').classList.remove('text-gray-600');
                    this.querySelector('i').classList.add('text-blue-700');

                    document.getElementById('selected-icon').value = this.dataset.icon;
                });
            });

            // Improved color selection script
            document.querySelectorAll('.color-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Reset all color options
                    document.querySelectorAll('.color-option').forEach(opt => {
                        opt.classList.remove('ring-4', 'ring-gray-800', 'scale-110');
                        opt.querySelector('.selected-check').classList.add('hidden');
                    });

                    // Apply selected styling
                    this.classList.add('ring-4', 'ring-gray-800', 'scale-110');
                    this.querySelector('.selected-check').classList.remove('hidden');

                    document.getElementById('selected-color').value = this.dataset.color;
                });
            });

            // Edit category
            document.querySelectorAll('.edit-category').forEach(btn => {
                btn.addEventListener('click', function() {
                    formTitle.textContent = 'Edit Kategori';
                    submitBtn.textContent = 'Update';

                    categoryIdInput.value = this.dataset.id;
                    document.getElementById('category-name').value = this.dataset.name;
                    document.getElementById('selected-icon').value = this.dataset.icon;
                    document.getElementById('selected-color').value = this.dataset.color;

                    // Select the icon
                    document.querySelectorAll('.icon-option').forEach(opt => {
                        if (opt.dataset.icon === this.dataset.icon) {
                            opt.classList.add('border-blue-500', 'border-2');
                        } else {
                            opt.classList.remove('border-blue-500', 'border-2');
                        }
                    });

                    // Select the color
                    document.querySelectorAll('.color-option').forEach(opt => {
                        if (opt.dataset.color === this.dataset.color) {
                            opt.classList.add('border-gray-800', 'border-2');
                        } else {
                            opt.classList.remove('border-gray-800', 'border-2');
                        }
                    });

                    formModal.classList.remove('hidden');
                });
            });

            // Delete category
            document.querySelectorAll('.delete-category').forEach(btn => {
                btn.addEventListener('click', function() {
                    const categoryId = this.dataset.id;
                    const categoryItem = this.closest('.category-item');

                    Swal.fire({
                        title: 'Hapus Kategori?',
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#000080',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/categories/${categoryId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire(
                                            'Terhapus!',
                                            'Kategori telah dihapus.',
                                            'success'
                                        );
                                        categoryItem.remove();
                                    } else {
                                        Swal.fire(
                                            'Gagal!',
                                            'Gagal menghapus kategori.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menghapus kategori.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });

            // Form submission
            categoryForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const url = categoryIdInput.value ? `/categories/${categoryIdInput.value}` : '/categories';
                const method = categoryIdInput.value ? 'PUT' : 'POST';

                // Show loading
                submitBtn.innerHTML = `
                <span class="inline-block animate-spin">
                    <i class="fas fa-circle-notch"></i>
                </span>
                Memproses...
            `;
                submitBtn.disabled = true;

                fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(Object.fromEntries(formData))
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: categoryIdInput.value ? 'Kategori berhasil diperbarui' :
                                    'Kategori berhasil ditambahkan',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                data.message || 'Terjadi kesalahan',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menyimpan kategori.',
                            'error'
                        );
                    })
                    .finally(() => {
                        submitBtn.innerHTML = categoryIdInput.value ? 'Update' : 'Simpan';
                        submitBtn.disabled = false;
                    });
            });
        });
    </script>

    <style>
        .navy-blue {
            background-color: #000080;
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .icon-option {
            position: relative;
            transition: all 0.2s ease;
        }

        .icon-option.selected-icon {
            transform: scale(1.05);
            box-shadow: 0 0 0 2px #3b82f6;
        }

        .icon-option.selected-icon i {
            font-size: 1.1em;
        }

        .color-option {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .color-option.ring-4 {
            box-shadow: 0 0 0 2px white, 0 0 0 4px #1f2937;
        }

        /* Animation for selection */
        @keyframes pulse-border {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(59, 130, 246, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }

        .selected-icon {
            animation: pulse-border 1s ease-out;
        }

        /* Edit form specific styling */
        #form-title.edit-mode {
            color: #3b82f6;
        }

        /* Improved modal backdrop */
        #category-form-modal {
            backdrop-filter: blur(3px);
        }

        /* Ensure the checkmark is visible on all color backgrounds */
        .selected-check i {
            filter: drop-shadow(0px 0px 1px rgba(0, 0, 0, 0.5));
            font-size: 1.2em;
        }
    </style>
@endsection
