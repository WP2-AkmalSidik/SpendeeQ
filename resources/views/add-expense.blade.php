@extends('layouts.app')

@section('content')
    <div class="page-content block" id="page-add">
        <!-- Header -->
        <div class="bg-blue-900 text-white px-4 py-3 rounded-b-2xl shadow-md relative">
            <div class="flex items-center justify-between">
                <a href="/" class="text-white text-lg">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-base font-semibold text-center flex-grow">Tambah Pengeluaran</h1>
            </div>
        </div>

        <!-- Form -->
        <div class="p-4">
            <div class="bg-white rounded-xl shadow-md p-5">
                <form>
                    <!-- Jumlah -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Rp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="amount" placeholder="0"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-xl font-medium"
                                required>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <div class="relative">
                            <select name="category"
                                class="block appearance-none w-full bg-white border border-gray-300 rounded-lg py-3 px-4 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="" disabled selected>Pilih kategori</option>
                                <option value="food">Makanan</option>
                                <option value="shopping">Belanja</option>
                                <option value="transport">Transportasi</option>
                                <option value="bills">Tagihan</option>
                                <option value="entertainment">Hiburan</option>
                                <option value="other">Lainnya</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <input type="text" name="description" placeholder="Contoh: Makan siang di restoran"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-gray-500"></i>
                            </div>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Waktu -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-clock text-gray-500"></i>
                            </div>
                            <input type="time" name="time" value="{{ date('H:i') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit"
                        class="navy-blue text-white w-full py-3 rounded-lg font-medium flex items-center justify-center hover:bg-blue-900 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        <span>Simpan Pengeluaran</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle quick category buttons
            document.querySelectorAll('.category-quick-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const category = this.getAttribute('data-category');
                    document.querySelector('select[name="category"]').value = category;

                    // Add visual feedback
                    document.querySelectorAll('.category-quick-btn').forEach(btn => {
                        btn.classList.remove('border-2', 'border-blue-500');
                    });
                    this.classList.add('border-2', 'border-blue-500');
                });
            });

            // Handle image upload preview
            const uploadContainer = document.getElementById('upload-container');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const imagePreview = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview-image');
            const receiptImage = document.getElementById('receipt-image');
            const removeImage = document.getElementById('remove-image');

            uploadContainer.addEventListener('click', function () {
                receiptImage.click();
            });

            receiptImage.addEventListener('change', function (e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const reader = new FileReader();

                    reader.onload = function (event) {
                        previewImage.src = event.target.result;
                        uploadPlaceholder.classList.add('hidden');
                        imagePreview.classList.remove('hidden');
                    };

                    reader.readAsDataURL(file);
                }
            });

            removeImage.addEventListener('click', function (e) {
                e.stopPropagation();
                receiptImage.value = '';
                previewImage.src = '#';
                uploadPlaceholder.classList.remove('hidden');
                imagePreview.classList.add('hidden');
            });

            // Set today's date and time by default
            const now = new Date();
            const timeString = now.getHours().toString().padStart(2, '0') + ':' +
                now.getMinutes().toString().padStart(2, '0');

            if (!document.querySelector('input[name="time"]').value) {
                document.querySelector('input[name="time"]').value = timeString;
            }
        });
    </script>
@endsection
