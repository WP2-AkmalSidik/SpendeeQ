<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SpandeeQ - Asisten Keuangan Pribadi</title>
    @vite('resources/css/app.css')
    <script src="{{ config('services.fontawesome.kit_url') }}" crossorigin="anonymous"></script>
    <style>
        .bg-navy {
            background-color: #000080;
        }

        .text-navy {
            color: #000080;
        }

        .border-navy {
            border-color: #000080;
        }

        .hover-navy:hover {
            background-color: #000080;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #000080 0%, #2a4365 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 128, 0.1), 0 10px 10px -5px rgba(0, 0, 128, 0.04);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 font-sans">
    <!-- Navigation -->
    <nav class="bg-white sticky top-0 z-50 shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="text-navy font-bold text-2xl">SpandeeQ</span>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="#fitur" class="px-3 py-2 text-slate-600 hover:text-navy transition duration-300">Fitur</a>
                <a href="#keunggulan"
                    class="px-3 py-2 text-slate-600 hover:text-navy transition duration-300">Keunggulan</a>
                <a href="#cara-kerja" class="px-3 py-2 text-slate-600 hover:text-navy transition duration-300">Cara
                    Kerja</a>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-navy font-medium border border-navy rounded-lg hover:bg-navy hover:text-white transition duration-300">Masuk</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-navy text-white font-medium rounded-lg hover:bg-blue-900 transition duration-300">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white">
        <div class="container mx-auto px-4 py-20 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Kelola Keuanganmu Dengan Mudah</h1>
                <p class="text-lg mb-8">SpandeeQ membantu Anda mencatat dan menganalisis pengeluaran harian dengan cara
                    yang sederhana namun efektif.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 bg-white text-navy font-bold rounded-lg text-center hover:bg-slate-100 transition duration-300">Mulai
                        Sekarang</a>
                    <a href="#demo"
                        class="px-6 py-3 border-2 border-white text-white font-bold rounded-lg text-center hover:bg-white/10 transition duration-300">Lihat
                        Demo</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('img/image.png') }}" alt="SpandeeQ Dashboard"
                    class="rounded-lg shadow-xl max-w-full h-auto" />
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="fitur" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-navy">Fitur Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-xl card-shadow hover:translate-y-[-5px] transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-pen-to-square text-navy text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-navy">Pencatatan Simpel</h3>
                    <p class="text-slate-600">Catat pengeluaran harian dalam hitungan detik, tanpa perlu input data yang
                        rumit atau berlebihan.</p>
                </div>
                <div class="p-6 rounded-xl card-shadow hover:translate-y-[-5px] transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-navy text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-navy">Analisis Visual</h3>
                    <p class="text-slate-600">Lihat grafik interaktif yang menunjukkan pola pengeluaran Anda dari waktu
                        ke waktu dengan tampilan yang informatif.</p>
                </div>
                <div class="p-6 rounded-xl card-shadow hover:translate-y-[-5px] transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-navy text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-navy">Notifikasi Cerdas</h3>
                    <p class="text-slate-600">Dapatkan pengingat dan saran ketika terjadi lonjakan pengeluaran dibanding
                        hari-hari sebelumnya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="cara-kerja" class="py-16 bg-slate-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-navy">Cara Kerja</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                <div>
                    <div
                        class="w-16 h-16 bg-navy rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                        1</div>
                    <h3 class="text-xl font-bold mb-2">Catat Transaksi</h3>
                    <p class="text-slate-600">Input setiap pengeluaran harian Anda dengan cepat dan mudah melalui
                        antarmuka yang simpel.</p>
                </div>
                <div>
                    <div
                        class="w-16 h-16 bg-navy rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                        2</div>
                    <h3 class="text-xl font-bold mb-2">Dapatkan Insight</h3>
                    <p class="text-slate-600">Lihat ringkasan dan visualisasi pengeluaran untuk memahami kebiasaan
                        belanja Anda.</p>
                </div>
                <div>
                    <div
                        class="w-16 h-16 bg-navy rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                        3</div>
                    <h3 class="text-xl font-bold mb-2">Kelola Lebih Baik</h3>
                    <p class="text-slate-600">Gunakan informasi dan saran yang diberikan untuk mengoptimalkan
                        pengeluaran Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages -->
    <section id="keunggulan" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-navy">Keunggulan SpandeeQ</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-navy"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Tanpa Fitur Berlebihan</h3>
                        <p class="text-slate-600">Fokus pada fungsi utama tanpa distraksi fitur kompleks yang jarang
                            digunakan.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-navy"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Antarmuka Intuitif</h3>
                        <p class="text-slate-600">Desain yang bersih dan mudah digunakan, bahkan untuk pengguna yang
                            baru mulai mengelola keuangan.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-navy"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Fokus pada Kesadaran</h3>
                        <p class="text-slate-600">Mendorong kebiasaan refleksi keuangan sehari-hari yang dapat
                            meningkatkan disiplin finansial.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-navy"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Tanpa Transfer Dana</h3>
                        <p class="text-slate-600">Aplikasi murni untuk pencatatan, tanpa risiko keamanan terkait
                            transaksi perbankan atau e-wallet.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 gradient-bg text-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Kata Pengguna Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 p-6 rounded-xl backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://avatar.iran.liara.run/public/boy" alt="User" class="w-12 h-12 rounded-full" />
                        <div class="ml-4">
                            <h4 class="font-bold">Andi Pratama</h4>
                            <div class="flex text-yellow-300">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p>"SpandeeQ mengubah cara saya memandang pengeluaran harian. Sekarang saya lebih sadar akan
                        kebiasaan belanja saya."</p>
                </div>
                <div class="bg-white/10 p-6 rounded-xl backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://avatar.iran.liara.run/public/girl" alt="User" class="w-12 h-12 rounded-full" />
                        <div class="ml-4">
                            <h4 class="font-bold">Dina Wijaya</h4>
                            <div class="flex text-yellow-300">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p>"Aplikasi yang simple namun sangat membantu! Saya akhirnya bisa melihat pola pengeluaran dan
                        mulai berhemat."</p>
                </div>
                <div class="bg-white/10 p-6 rounded-xl backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://avatar.iran.liara.run/public/boy" alt="User" class="w-12 h-12 rounded-full" />
                        <div class="ml-4">
                            <h4 class="font-bold">Budi Santoso</h4>
                            <div class="flex text-yellow-300">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p>"Saya menyukai notifikasi dan saran yang diberikan. Sangat membantu untuk mengendalikan
                        pengeluaran impulsif."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="demo" class="py-20 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4 text-navy">Siap Mengelola Keuangan Lebih Baik?</h2>
            <p class="text-xl text-slate-600 mb-8 max-w-2xl mx-auto">Mulai catat pengeluaran harianmu secara efektif dan
                lihat perubahan positif dalam kebiasaan finansialmu.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('register') }}"
                    class="px-8 py-4 bg-navy text-white font-bold rounded-lg hover:bg-blue-900 transition duration-300">Daftar
                    Gratis</a>
                <a href="{{ route('login') }}"
                    class="px-8 py-4 border-2 border-navy text-navy font-bold rounded-lg hover:bg-navy/5 transition duration-300">Masuk
                    ke Akun</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between pb-8 border-b border-slate-700">
                <div class="mb-6 md:mb-0">
                    <span class="text-2xl font-bold">SpandeeQ</span>
                    <p class="mt-2 text-slate-300 max-w-xs">Asisten keuangan pribadi untuk membantu Anda mengelola
                        pengeluaran sehari-hari dengan lebih efektif.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Perusahaan</h3>
                        <ul class="space-y-2 text-slate-300">
                            <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-white transition">Karir</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Bantuan</h3>
                        <ul class="space-y-2 text-slate-300">
                            <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                            <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                            <li><a href="#" class="hover:text-white transition">Panduan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Legal</h3>
                        <ul class="space-y-2 text-slate-300">
                            <li><a href="#" class="hover:text-white transition">Syarat Layanan</a></li>
                            <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                            <li><a href="#" class="hover:text-white transition">Keamanan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-slate-400 mb-4 md:mb-0">© 2025 SpandeeQ. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-slate-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-slate-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-slate-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-slate-400 hover:text-white transition"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
