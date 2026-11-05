@extends('layouts.layout')
@section('content')

    <div class="admin-card">
    
    <!-- Bagian Judul -->
    <div class="admin-header">
        <h2>Daftar Pengelola</h2>
        <!-- Arahkan ke rute tambah admin Anda -->
        <a href="{{ route('registrasi') }}" class="btn-tambah">+ Tambah Admin</a>
    </div>

    <!-- Bagian Tabel -->
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            
            <!-- CONTOH LOOPING LARAVEL NANTINYA: -->
           @foreach ($dataAdmin as $item)
               
            <tr>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>
        <!-- Menampilkan Badge Jabatan -->
        @if($item->role === 'superadmin')
            <span class="badge" style="background: #EEF2FF; color: #4F46E5;">Super Admin</span>
        @else
            <span class="badge bg-light text-dark">Admin</span>
        @endif  
    </td>
    
    <td style="text-align: right;">
        <!-- KUNCI PROTEKSI TAMPILAN -->
        @if($item->role === 'superadmin')
            <!-- Jika dia superadmin, tampilkan teks abu-abu pengganti tombol -->
            <span style="color: #9CA3AF; font-size: 0.85rem; font-style: italic;">Bawaan Sistem</span>
        @else
            
            <form action="{{ route('admin.delete', $item->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn-icon delete" style="color: var(--danger);" title="Hapus"><i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"></i></button>
            </form>
        @endif
    </td>
</tr>
           @endforeach
            
        </tbody>
    </table>
</div>

@foreach ($dataAdmin as $item)
<!-- MODAL KONFIRMASI HAPUS (Bootstrap 5) -->
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-sm">
    <form action="{{ route('admin.delete', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
        <div class="modal-content text-center border-0 shadow">
            <div class="modal-body p-4">
                <div class="text-danger mb-3">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem;"></i>
                </div>
                <h5 class="modal-title fw-bold mb-2" id="deleteModalLabel">Yakin ingin menghapus Admin?</h5>
                <p class="text-muted text-sm mb-4">{{ $item->name }}</p>
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light w-50" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger w-50">Hapus</button>
                </div>
            </div>
        </div>
    </form>         
</div>
</div>
@endforeach
@endsection