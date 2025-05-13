@extends('layouts.app')

@section('title', 'Profil')

@section('header-action')
<a href="/settings" class="text-white">
    <i class="fas fa-gear text-lg"></i>
</a>
@endsection

@section('content')
    <div class="page-content block" id="page-profile">
        <!-- Header -->
        <div class="navy-blue text-white p-6 rounded-b-3xl shadow-lg">
            <div class="flex items-center space-x-4">
                <a href="/" class="text-white">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-xl font-bold text-center">Profil</h1>
            </div>
        </div>

        <!-- Profile Header -->
        <div class="flex flex-col items-center p-6">
            <div class="relative mb-3">
                <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden border-4 border-white shadow-lg">
                    <img src="https://i.pravatar.cc/150?img=32" alt="Profile Picture" class="object-cover w-full h-full">
                </div>
                <button class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 rounded-full text-white flex items-center justify-center shadow-md border-2 border-white hover:bg-blue-700 transition-colors">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
            <h1 class="text-xl font-bold">Budi Santoso</h1>
            <p class="text-gray-600">@budisantoso</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-4 px-4 mb-6">
            <!-- Total Expenses -->
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-2">
                        <i class="fas fa-money-bill-wave text-blue-500"></i>
                    </div>
                    <h3 class="text-sm font-medium">Total Pengeluaran</h3>
                </div>
                <p class="text-2xl font-bold">Rp 8.590.000</p>
                <p class="text-xs text-gray-600">Bulan ini</p>
            </div>

            <!-- Expenses Count -->
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center mr-2">
                        <i class="fas fa-receipt text-purple-500"></i>
                    </div>
                    <h3 class="text-sm font-medium">Transaksi</h3>
                </div>
                <p class="text-2xl font-bold">124</p>
                <p class="text-xs text-gray-600">Bulan ini</p>
            </div>
        </div>

        <!-- Account Settings -->
        <div class="bg-white rounded-xl shadow overflow-hidden mx-4 mb-6">
            <div class="px-4 py-3 bg-gray-50 border-b">
                <h3 class="font-medium">Pengaturan Akun</h3>
            </div>

            <div class="divide-y">
                <!-- Edit Profile -->
                <a href="/profile/edit" class="block p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 mr-3">
                            <i class="fas fa-user-pen"></i>
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-medium">Edit Profil</h4>
                            <p class="text-sm text-gray-500">Ubah nama, username, dan foto profil</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>
                </a>

                <!-- Change Password -->
                <a href="/profile/password" class="block p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-500 mr-3">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-medium">Ganti Password</h4>
                            <p class="text-sm text-gray-500">Ubah password akun anda</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Password Change Form (Modal) -->
        <div id="password-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Ganti Password</h3>
                        <button id="close-password-modal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="password-form">
                        <!-- Current Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                            <div class="relative">
                                <input type="password" name="current_password" placeholder="Masukkan password saat ini"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <div class="relative">
                                <input type="password" name="new_password" placeholder="Masukkan password baru"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Password minimal 8 karakter</p>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input type="password" name="confirm_password" placeholder="Konfirmasi password baru"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="button" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 mt-6">
                            <button type="submit"
                                class="flex-1 navy-blue text-white font-medium py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                                Simpan Password
                            </button>
                            <button type="button" id="cancel-password-change"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- App Info & Logout -->
        <div class="bg-white rounded-xl shadow overflow-hidden mx-4 mb-6">
            <div class="divide-y">
                <!-- App Info -->
                <a href="/about" class="block p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-500 mr-3">
                            <i class="fas fa-circle-info"></i>
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-medium">Tentang Aplikasi</h4>
                            <p class="text-sm text-gray-500">Versi 1.0.0</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>
                </a>

                <!-- Logout -->
                <button id="logout-btn" class="block w-full text-left p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center text-red-500">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <h4 class="font-medium">Keluar</h4>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Password modal handling
            const passwordModal = document.getElementById('password-modal');
            const closePasswordModal = document.getElementById('close-password-modal');
            const cancelPasswordChange = document.getElementById('cancel-password-change');
            const passwordForm = document.getElementById('password-form');

            // Show password modal when clicking on change password link
            document.querySelector('a[href="/profile/password"]').addEventListener('click', function(e) {
                e.preventDefault();
                passwordModal.classList.remove('hidden');
            });

            // Close password modal
            function closePasswordModalFunc() {
                passwordModal.classList.add('hidden');
                passwordForm.reset();
            }

            closePasswordModal.addEventListener('click', closePasswordModalFunc);
            cancelPasswordChange.addEventListener('click', closePasswordModalFunc);

            // Form submission
            passwordForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Here you would typically send the form data to your backend
                const formData = new FormData(this);
                console.log('Password form data:', Object.fromEntries(formData));

                // Show success message
                alert('Password berhasil diubah!');

                // Close the modal
                closePasswordModalFunc();
            });

            // Logout confirmation
            document.getElementById('logout-btn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    // Here you would typically call your logout API
                    console.log('User logged out');
                    // Then redirect to login page
                    window.location.href = '/login';
                }
            });

            // Profile picture change handler
            document.querySelector('.relative.mb-3 button').addEventListener('click', function() {
                // In a real app, this would open the file picker or camera
                alert('Fitur perubahan foto profil akan membuka kamera/gallery');
            });
        });
    </script>
@endsection
