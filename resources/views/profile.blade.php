@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="page-content block" id="page-profile">
        <!-- Header -->
        <div class="bg-blue-900 text-white px-4 py-3 rounded-b-2xl shadow-md relative">
            <div class="flex items-center justify-between">
                <a href="{{ url()->previous() }}" class="text-white text-lg">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-base font-semibold text-center flex-grow">Profile</h1>
            </div>
        </div>

        <!-- Profile Header -->
        <div class="flex flex-col items-center p-6">
            <div class="relative mb-3">
                <div
                    class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden border-4 border-white shadow-lg">
                    @if (Auth::user()->profile_photo)
                        <img src="{{ Storage::url(Auth::user()->profile_photo) }}" alt="Profile Picture"
                            class="object-cover w-full h-full" id="profile-image">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                            alt="Profile Picture" class="object-cover w-full h-full" id="profile-image">
                    @endif
                </div>
                <button id="trigger-edit-profile"
                    class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 rounded-full text-white flex items-center justify-center shadow-md border-2 border-white hover:bg-blue-700 transition-colors">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
            <h1 class="text-xl font-bold" id="profile-name">{{ Auth::user()->name }}</h1>
            <p class="text-gray-600" id="profile-email">{{ Auth::user()->email }}</p>
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
                <p class="text-2xl font-bold">Rp {{ number_format($totalExpensesThisMonth, 0, ',', '.') }}</p>
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
                <p class="text-2xl font-bold">{{ $expenseCountThisMonth }}</p>
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
                <a href="#" id="edit-profile-btn" class="block p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 mr-3">
                            <i class="fas fa-user-pen"></i>
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-medium">Edit Profil</h4>
                            <p class="text-sm text-gray-500">Ubah nama dan foto profil</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>
                </a>

                <!-- Change Password -->
                <a href="#" id="change-password-btn" class="block p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-500 mr-3">
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

        <!-- Edit Profile Modal -->
        <div id="edit-profile-modal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Edit Profil</h3>
                        <button id="close-profile-modal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="profile-form" enctype="multipart/form-data">
                        @csrf
                        <!-- Profile Picture Preview -->
                        <div class="flex flex-col items-center mb-6">
                            <div
                                class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden border-4 border-white shadow-lg mb-3">
                                @if (Auth::user()->profile_photo)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo) }}" alt="Profile Picture Preview"
                                        class="object-cover w-full h-full" id="profile-preview">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                                        alt="Profile Picture Preview" class="object-cover w-full h-full"
                                        id="profile-preview">
                                @endif
                            </div>
                            <div class="flex items-center">
                                <label for="profile-upload"
                                    class="cursor-pointer text-blue-500 font-medium flex items-center">
                                    <i class="fas fa-camera mr-2"></i>
                                    Ganti Foto
                                </label>
                                <input type="file" name="profile_photo" id="profile-upload" accept="image/*"
                                    class="hidden">
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" id="name-input" placeholder="Masukkan nama lengkap"
                                value="{{ Auth::user()->name }}"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 mt-6">
                            <button type="submit" id="save-profile"
                                class="flex-1 navy-blue text-white font-medium py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                                Simpan Profil
                            </button>
                            <button type="button" id="cancel-profile-edit"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Change Form (Modal) -->
        <div id="password-modal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Ganti Password</h3>
                        <button id="close-password-modal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="password-form">
                        @csrf
                        <!-- New Password -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <div class="relative">
                                <input type="password" name="new_password" id="new-password"
                                    placeholder="Masukkan password baru"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                <button type="button"
                                    class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Password minimal 8 karakter</p>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input type="password" name="new_password_confirmation" id="confirm-password"
                                    placeholder="Konfirmasi password baru"
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                <button type="button"
                                    class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 mt-6">
                            <button type="submit" id="save-password"
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
                <div class="px-4 py-3 bg-gray-50 border-b">
                    <h3 class="font-medium">Info & Logout</h3>
                </div>
                <!-- App Info -->
                <a href="/about" class="block p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-500 mr-3">
                            <i class="fas fa-circle-info"></i>
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-medium">Tentang Website</h4>
                            <p class="text-sm text-gray-500">Versi 1.0.0</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </div>
                </a>

                <!-- Logout -->
                <button type="button" id="logout-btn"
                    class="block w-full text-left p-4 hover:bg-gray-50 transition-colors">
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

            // Edit Profile Modal Handling
            const editProfileModal = document.getElementById('edit-profile-modal');
            const closeProfileModal = document.getElementById('close-profile-modal');
            const cancelProfileEdit = document.getElementById('cancel-profile-edit');
            const profileForm = document.getElementById('profile-form');
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const triggerEditProfile = document.getElementById('trigger-edit-profile');
            const profileUpload = document.getElementById('profile-upload');
            const profilePreview = document.getElementById('profile-preview');
            const nameInput = document.getElementById('name-input');
            const profileName = document.getElementById('profile-name');
            const profileImage = document.getElementById('profile-image');

            // Show edit profile modal
            function openEditProfileModal() {
                editProfileModal.classList.remove('hidden');
                nameInput.value = profileName.textContent;
                profilePreview.src = profileImage.src;
            }

            editProfileBtn.addEventListener('click', function(e) {
                e.preventDefault();
                openEditProfileModal();
            });

            triggerEditProfile.addEventListener('click', function() {
                openEditProfileModal();
            });

            // Close edit profile modal
            function closeEditProfileModalFunc() {
                editProfileModal.classList.add('hidden');
            }

            closeProfileModal.addEventListener('click', closeEditProfileModalFunc);
            cancelProfileEdit.addEventListener('click', closeEditProfileModalFunc);

            // Handle profile image preview
            profileUpload.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                    }

                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Save profile changes
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = document.getElementById('save-profile');

                // Show loading state
                submitBtn.innerHTML = `
                <span class="inline-block animate-spin">
                    <i class="fas fa-circle-notch"></i>
                </span>
                Menyimpan...
            `;
                submitBtn.disabled = true;

                fetch('/profile/update', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Update UI
                            profileName.textContent = data.user.name;
                            if (data.user.profile_photo) {
                                profileImage.src = data.user.profile_photo;
                                profilePreview.src = data.user.profile_photo;
                            }

                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#000080'
                            });

                            // Close modal
                            closeEditProfileModalFunc();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message || 'Terjadi kesalahan saat menyimpan profil',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#000080'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menyimpan profil',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#000080'
                        });
                    })
                    .finally(() => {
                        submitBtn.innerHTML = 'Simpan Profil';
                        submitBtn.disabled = false;
                    });
            });

            // Password modal handling
            const passwordModal = document.getElementById('password-modal');
            const closePasswordModal = document.getElementById('close-password-modal');
            const cancelPasswordChange = document.getElementById('cancel-password-change');
            const passwordForm = document.getElementById('password-form');
            const changePasswordBtn = document.getElementById('change-password-btn');

            // Show password modal when clicking on change password link
            changePasswordBtn.addEventListener('click', function(e) {
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

            // Password form submission
            passwordForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = document.getElementById('save-password');

                // Show loading state
                submitBtn.innerHTML = `
                <span class="inline-block animate-spin">
                    <i class="fas fa-circle-notch"></i>
                </span>
                Menyimpan...
            `;
                submitBtn.disabled = true;

                // Validate passwords match
                const newPassword = document.getElementById('new-password').value;
                const confirmPassword = document.getElementById('confirm-password').value;

                if (newPassword.length < 8) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Terlalu Pendek',
                        text: 'Password harus minimal 8 karakter',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#000080'
                    });
                    submitBtn.innerHTML = 'Simpan Password';
                    submitBtn.disabled = false;
                    return;
                }

                if (newPassword !== confirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Tidak Sama',
                        text: 'Password baru dan konfirmasi password tidak cocok',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#000080'
                    });
                    submitBtn.innerHTML = 'Simpan Password';
                    submitBtn.disabled = false;
                    return;
                }

                fetch('/profile/update-password', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#000080'
                            });

                            // Close modal
                            closePasswordModalFunc();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message ||
                                    'Terjadi kesalahan saat mengubah password',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#000080'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengubah password',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#000080'
                        });
                    })
                    .finally(() => {
                        submitBtn.innerHTML = 'Simpan Password';
                        submitBtn.disabled = false;
                    });
            });

            // Logout confirmation with SweetAlert2
            document.getElementById('logout-btn').addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Keluar dari Aplikasi?',
                    text: "Anda akan keluar dari akun anda",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Keluar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the logout form
                        fetch('/logout', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        }).then(() => {
                            window.location.href = '/';
                        });
                    }
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
    </style>
@endsection
