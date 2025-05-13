<!-- Register Page -->
@extends('layouts.auth')

@section('content')
    <div class="min-h-screen flex flex-col bg-gray-50">
        <!-- Header -->
        <div class="navy-blue text-white p-4 md:p-6 rounded-b-3xl shadow-lg">
            <div class="flex justify-center items-center mb-3 md:mb-4">
                <!-- Logo Judul -->
                <div class="flex items-center space-x-1">
                    <div class="relative inline-block">
                        <h1 class="text-2xl md:text-3xl font-bold relative z-10">Spendee</h1>
                        <div class="text-3xl absolute top-1/2 left-full -translate-x-3 -translate-y-1/2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-black font-bold z-0"
                            style="margin-top: 3px; margin-left: 5px;">
                            Q
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Auth Container -->
        <div class="flex-grow flex flex-col justify-center items-center px-4 py-6 md:py-10">
            <div class="w-full max-w-md">
                <!-- Tabs -->
                <div class="flex mb-6 bg-white rounded-lg shadow-sm overflow-hidden">
                    <a href="{{ route('login') }}"
                        class="flex-1 py-3 text-center font-medium text-gray-600 bg-white rounded-l-lg">Masuk</a>
                    <a href="/regis"
                        class="flex-1 py-3 text-center font-medium text-white navy-blue rounded-r-lg">Daftar</a>
                </div>

                <!-- Register Form -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h2 class="text-xl font-bold mb-6 text-center navy-text">Buat Akun Baru</h2>

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input id="name" type="text"
                                    class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" type="email"
                                    class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="contoh@email.com">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password" type="password"
                                    class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                                <button type="button"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="mt-1 text-xs text-gray-500">Password harus memiliki minimal 8 karakter</div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-4">
                            <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                                Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password-confirm" type="password"
                                    class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Ulangi password">
                                <button type="button"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start mb-6">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                            </div>
                            <label for="terms" class="ml-2 text-xs text-gray-600">
                                Saya menyetujui <a href="#" class="text-blue-500 hover:underline">Syarat & Ketentuan</a> dan
                                <a href="#" class="text-blue-500 hover:underline">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3 px-4 navy-blue hover:bg-blue-900 text-white font-medium rounded-lg shadow-sm transition duration-150">
                            Daftar Sekarang
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <div class="px-3 text-xs text-gray-500">atau daftar dengan</div>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <!-- Social Logins -->
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            class="flex items-center justify-center py-2.5 px-4 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition duration-150">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            <span class="text-sm font-medium">Google</span>
                        </button>
                        <button
                            class="flex items-center justify-center py-2.5 px-4 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition duration-150">
                            <i class="fab fa-facebook-f mr-2"></i>
                            <span class="text-sm font-medium">Facebook</span>
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun? <a href="{{ route('login') }}"
                                class="text-blue-500 hover:underline font-medium">Masuk</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center p-4">
            <p class="text-sm text-gray-500">© 2025 Spendee. Semua hak dilindungi.</p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const input = this.closest('div').querySelector('input');
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
        });
    </script>

    <style>
        .navy-blue {
            background-color: #000080;
        }

        .navy-text {
            color: #000080;
        }
    </style>
@endsection
