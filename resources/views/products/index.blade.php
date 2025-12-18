<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- 1. Bungkus Tombol TAMBAH dengan @role --}}
                    {{-- Hanya Admin yang bisa melihat tombol ini --}}
                    @role('admin')
                        <div class="mb-4">
                            <a href="{{ route('products.create') }}"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold text-sm shadow-sm transition duration-150 ease-in-out">
                                + Tambah Produk
                            </a>
                        </div>
                    @endrole

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="relative overflow-x-auto border sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 border-b">No</th>
                                    <th scope="col" class="px-6 py-3 border-b">Nama Produk</th>
                                    <th scope="col" class="px-6 py-3 border-b">Harga</th>
                                    <th scope="col" class="px-6 py-3 border-b">Kategori</th>

                                    {{-- 2. Bungkus Header Kolom AKSI dengan @role --}}
                                    {{-- Kolom 'Aksi' akan hilang jika bukan admin --}}
                                    @role('admin')
                                        <th scope="col" class="px-6 py-3 border-b">Aksi</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                {{ $product->category->name ?? '-' }}
                                            </span>
                                        </td>

                                        {{-- 3. Bungkus Isi Kolom AKSI dengan @role --}}
                                        {{-- Tombol Edit & Hapus disembunyikan untuk user biasa --}}
                                        @role('admin')
                                            <td class="px-6 py-4 flex gap-2">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="font-medium text-yellow-600 hover:text-yellow-500 hover:underline">
                                                    Edit
                                                </a>

                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin hapus produk ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="font-medium text-red-600 hover:text-red-500 hover:underline">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        @endrole
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Data produk belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
