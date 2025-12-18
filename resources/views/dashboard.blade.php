<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Grid Container --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- KARTU 1: TOTAL PRODUK (TEMA ORANGE) --}}
                <div class="relative overflow-hidden rounded-2xl shadow-xl bg-gradient-to-br from-orange-400 to-orange-600 text-white transform hover:scale-105 transition duration-300">

                    {{-- Dekorasi Lingkaran Samar (Style Putih Transparan) --}}
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-white opacity-20 rounded-full blur-xl"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-yellow-300 opacity-20 rounded-full blur-2xl"></div>

                    <div class="p-8 relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 font-medium text-lg mb-1">Total Produk</p>
                            <h3 class="text-5xl font-bold">{{ $totalProducts }}</h3>
                            <a href="{{ route('products.index') }}" class="inline-block mt-4 text-sm font-semibold text-orange-100 hover:text-white underline decoration-orange-200 underline-offset-4">
                                Lihat Semua Produk &rarr;
                            </a>
                        </div>
                        {{-- Icon Box (Background Putih Transparan) --}}
                        <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- KARTU 2: TOTAL KATEGORI (TEMA PUTIH) --}}
                {{-- Struktur kode SAMA PERSIS, hanya beda warna background & text --}}
                <div class="relative overflow-hidden rounded-2xl shadow-xl bg-white dark:bg-gray-800 text-gray-800 dark:text-white transform hover:scale-105 transition duration-300 border border-gray-100 dark:border-gray-700">

                    {{-- Dekorasi Lingkaran Samar (Style Orange Pudar agar terlihat di putih) --}}
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-orange-400 opacity-10 rounded-full blur-xl"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-gray-300 opacity-10 rounded-full blur-2xl"></div>

                    <div class="p-8 relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium text-lg mb-1">Total Kategori</p>
                            <h3 class="text-5xl font-bold">{{ $totalCategories }}</h3>
                            {{-- Link warna orange agar kontras --}}
                            <a href="{{ route('categories.index') }}" class="inline-block mt-4 text-sm font-semibold text-orange-500 hover:text-orange-600 underline decoration-orange-200 underline-offset-4">
                                Atur Kategori &rarr;
                            </a>
                        </div>
                        {{-- Icon Box (Background Orange Pudar) --}}
                        <div class="p-4 bg-orange-50 dark:bg-gray-700 rounded-2xl backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-orange-500 dark:text-orange-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Selamat Datang --}}
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Sistem manajemen stok produk dan kategori siap digunakan.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
