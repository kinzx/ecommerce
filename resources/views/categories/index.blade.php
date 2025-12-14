<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-5">
        <h1>Daftar Kategori</h1>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">

            {{-- 1. Notifikasi SUKSES (Hijau) --}}
            @if (session('success'))
                <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            {{-- 2. Notifikasi WARNING (Kuning) --}}
            @if (session('warning'))
                <div class="toast align-items-center text-bg-warning border-0 show" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body text-dark">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('warning') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            {{-- 3. Notifikasi DANGER (Merah) --}}
            @if (session('danger'))
                <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-trash-fill me-2"></i> {{ session('danger') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

        </div>

        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3"> + Tambah Kategori</a>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-action="{{ route('categories.destroy', $category->id) }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Data kategori tidak tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ambil semua elemen toast
        const toastElList = document.querySelectorAll('.toast');

        // Inisialisasi toast
        const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, {
            autohide: true, // Otomatis hilang
            delay: 4000 // Hilang setelah 4 detik
        }));

        // Tampilkan toast (karena kita pakai class 'show' manual di atas, script ini opsional
        // tapi bagus untuk memastikan fitur close berfungsi dengan animasi)
        toastList.forEach(toast => toast.show());
    </script>
    <script>
        // Ambil elemen modal
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        // Saat modal akan dibuka
        deleteModal.addEventListener('show.bs.modal', function(event) {
            // Tombol yang memicu modal
            const button = event.relatedTarget;

            // Ambil URL dari attribute data-action di tombol
            const actionUrl = button.getAttribute('data-action');

            // Isi action form dengan URL tersebut
            deleteForm.action = actionUrl;
        });
    </script>
</body>

</html>
