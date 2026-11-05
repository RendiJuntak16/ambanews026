@extends('layouts.layout')
@section('content')
    
<!-- Main Content Area -->
<main class="admin-content">
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-6" style="flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2>Manajemen Konten</h2>
            <p class="text-sm mt-1">Kelola publikasi artikel berita Anda di sini.</p>
        </div>
        <a href="/admin/new-article">
             <button class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Tambah Berita
            </button>
        </a>
       
    </div>
    
    <!-- Tabel Data Artikel -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul Berita</th>
                    <th>Kategori</th>
                    <th>Tgl Publish</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>

               @foreach ($data as $item)
                   <tr id="row-1">
                    <td style="font-weight: 500;">{{ $item->title }}</td>
                    <td><span class="badge badge-sport">{{ $item->category }}</span></td>
                    <td>{{ $item->created_at->format('d F Y') }}</td>
                    <td style="text-align: right; white-space: nowrap;">
                        <a href="{{ route('article.edit', $item->id_article ) }}"><button class="btn-icon" style="color: var(--primary);" title="Edit"><i class="fa-solid fa-pencil"></i></button></a>
                        <!-- Button trigger modal delete -->
                     <button type="button" class="btn-icon delete" style="color: var(--danger);" title="Hapus"><i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_article }}"></i></button>

               @endforeach
                    
            </tbody>
        </table>
    </div>
</main>
</div>

@foreach ($data as $item)
<!-- MODAL KONFIRMASI HAPUS (Bootstrap 5) -->
<div class="modal fade" id="deleteModal{{ $item->id_article }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-sm">
    <form action="{{ route('article.delete', $item->id_article) }}" method="POST">
            @csrf
            @method('DELETE')
        <div class="modal-content text-center border-0 shadow">
            <div class="modal-body p-4">
                <div class="text-danger mb-3">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem;"></i>
                </div>
                <h5 class="modal-title fw-bold mb-2" id="deleteModalLabel">Yakin ingin menghapus?</h5>
                <p class="text-muted text-sm mb-4">Tindakan ini permanen. Artikel beserta gambarnya akan dihapus.</p>
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light w-50" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger w-50">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>         
</div>
</div>
@endforeach
<!-- TOAST NOTIFIKASI SUKSES (Berdasarkan Session Laravel) -->
<!-- Kode ini HANYA dirender jika ada pesan 'success' dari Controller -->
@if (session('massage'))
<!-- TOAST NOTIFIKASI SUKSES (Bootstrap 5) -->
<div class="toast-container position-fixed bottom-0 end-0 p-4">
<div id="successToast" class="toast align-items-center text-bg-dark border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body fw-medium">
            <i class="fa-solid fa-circle-check text-success me-2 fs-5 align-middle"></i> 
            <span class="align-middle">{{ session('massage') }}</span>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Ambil elemen toast kita
    var toastEl = document.getElementById('successToast');
    // Inisialisasi menggunakan API Bootstrap (tampil 3 detik)
    var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
    // Munculkan toast-nya
    toast.show();
});
</script>
@endif

@if (session('success'))
<!-- TOAST NOTIFIKASI SUKSES (Bootstrap 5) -->
<div class="toast-container position-fixed bottom-0 end-0 p-4">
<div id="successToast" class="toast align-items-center text-bg-dark border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body fw-medium">
            <i class="fa-solid fa-circle-check text-success me-2 fs-5 align-middle"></i> 
            <span class="align-middle">{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Ambil elemen toast kita
    var toastEl = document.getElementById('successToast');
    // Inisialisasi menggunakan API Bootstrap (tampil 3 detik)
    var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
    // Munculkan toast-nya
    toast.show();
});
</script>
@endif
    @endsection
    
     