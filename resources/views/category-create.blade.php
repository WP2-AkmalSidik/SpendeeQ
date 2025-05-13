@extends('layouts.app')

@section('header_title', 'Tambah Kategori')

@section('header_action')
    <a href="/categories" class="text-white">
        <i class="fas fa-times"></i>
    </a>
@endsection

@section('content')
    <div class="bg-white rounded-xl shadow-md p-5">
        <form class="space-y-5">
            <!-- Category Name Input -->
            <div>
                <label class="block text-text-muted text-sm font-medium mb-2" for="name">
                    Nama Kategori
                </label>
                <input type="text" id="name"
                    class="block w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
                    placeholder="Masukkan nama kategori" autofocus>
            </div>

            <!-- Icon Selection -->
            <div>
                <label class="block text-text-muted text-sm font-medium mb-2">
                    Pilih Ikon
                </label>
                <div class="grid grid-cols-4 gap-3">
                    <div class="category-icon">
                        <input type="radio" id="icon-utensils" name="icon" value="fa-utensils" class="hidden peer">
                        <label for="icon-utensils"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-utensils text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-bus" name="icon" value="fa-bus" class="hidden peer">
                        <label for="icon-bus"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-bus text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-shopping-bag" name="icon" value="fa-shopping-bag" class="hidden peer">
                        <label for="icon-shopping-bag"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-shopping-bag text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-film" name="icon" value="fa-film" class="hidden peer">
                        <label for="icon-film"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-film text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-file-invoice" name="icon" value="fa-file-invoice" class="hidden peer">
                        <label for="icon-file-invoice"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-file-invoice text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-coffee" name="icon" value="fa-coffee" class="hidden peer">
                        <label for="icon-coffee"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-coffee text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-gift" name="icon" value="fa-gift" class="hidden peer">
                        <label for="icon-gift"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-gift text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-gamepad" name="icon" value="fa-gamepad" class="hidden peer">
                        <label for="icon-gamepad"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-gamepad text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-tshirt" name="icon" value="fa-tshirt" class="hidden peer">
                        <label for="icon-tshirt"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-tshirt text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-medkit" name="icon" value="fa-medkit" class="hidden peer">
                        <label for="icon-medkit"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-medkit text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-book" name="icon" value="fa-book" class="hidden peer">
                        <label for="icon-book"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-book text-xl"></i>
                        </label>
                    </div>
                    <div class="category-icon">
                        <input type="radio" id="icon-ellipsis-h" name="icon" value="fa-ellipsis-h" class="hidden peer">
                        <label for="icon-ellipsis-h"
                            class="flex items-center justify-center p-3 border rounded-lg text-center cursor-pointer peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary hover:bg-gray-50">
                            <i class="fas fa-ellipsis-h text-xl"></i>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Color Selection -->
            <div>
                <label class="block text-text-muted text-sm font-medium mb-2">
                    Pilih Warna
                </label>
                <div class="grid grid-cols-6 gap-3">
                    <div class="color-option">
                        <input type="radio" id="color-red" name="color" value="red" class="hidden peer">
                        <label for="color-red"
                            class="block h-10 rounded-lg bg-red-500 cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-red-500"></label>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color-blue" name="color" value="blue" class="hidden peer">
                        <label for="color-blue"
                            class="block h-10 rounded-lg bg-blue-500 cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-blue-500"></label>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color-green" name="color" value="green" class="hidden peer">
                        <label for="color-green"
                            class="block h-10 rounded-lg bg-green-500 cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-green-500"></label>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color-yellow" name="color" value="yellow" class="hidden peer">
                        <label for="color-yellow"
                            class="block h-10 rounded-lg bg-yellow-500 cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-yellow-500"></label>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color-purple" name="color" value="purple" class="hidden peer">
                        <label for="color-purple"
                            class="block h-10 rounded-lg bg-purple-500 cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-purple-500"></label>
                    </div>
                    <div class="color-option">
                        <input type="radio" id="color-gray" name="color" value="gray" class="hidden peer">
                        <label for="color-gray"
                            class="block h-10 rounded-lg bg-gray-500 cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-gray-500"></label>
                    </div>
                </div>
            </div>

            <!-- Description Input -->
            <div>
                <label class="block text-text-muted text-sm font-medium mb-2" for="description">
                    Deskripsi (opsional)
                </label>
                <textarea id="description" rows="3"
                    class="block w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
                    placeholder="Tambahkan deskripsi kategori..."></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-3">
                <button type="submit"
                    class="w-full bg-primary hover:bg-opacity-90 text-white font-medium py-3 px-4 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kategori
                </button>
            </div>
        </form>
    </div>
@endsection
