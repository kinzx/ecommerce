<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- 1. Tombol Tambah (Khusus Admin) --}}
                    @role('admin')
                        <div class="mb-4">
                            <a href="{{ route('categories.create') }}"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold text-sm shadow-sm transition duration-150 ease-in-out">
                                + Tambah Kategori
                            </a>
                        </div>
                    @endrole

                    {{-- TABEL KATEGORI --}}
                    <div class="relative overflow-x-auto border sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            {{-- Header Tabel --}}
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 border-b">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-b">
                                        Nama Kategori
                                    </th>

                                    {{-- 2. Header Aksi (Khusus Admin) --}}
                                    @role('admin')
                                        <th scope="col" class="px-6 py-3 border-b">
                                            Aksi
                                        </th>
                                    @endrole
                                </tr>
                            </thead>

                            {{-- Body Tabel --}}
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                        {{-- Kolom No --}}
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </td>

                                        {{-- Kolom Nama --}}
                                        <td class="px-6 py-4">
                                            {{ $category->name }}
                                        </td>

                                        {{-- 3. Kolom Aksi (Khusus Admin) --}}
                                        @role('admin')
                                            <td class="px-6 py-4 flex gap-2">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="font-medium text-yellow-600 hover:text-yellow-500 hover:underline">
                                                    Edit
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                            Data kategori belum tersedia.
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
