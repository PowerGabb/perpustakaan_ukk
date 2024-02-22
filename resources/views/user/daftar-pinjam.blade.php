@extends('layouts.index')
@section('title', 'Daftar Pinjamku')
@section('content')
    <div class="card">
        <div class="d-flex justify-content-between card-header">
            <div>
                <h5 class="">List Dipinjam</h5>
            </div>
            <div>
                <a href="/home" class="btn btn-dark btn-sm">Cari Buku</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Status</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($pinjaman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->buku->judul }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->tanggal_peminjaman }}</td>
                            <td>
                                @if ($item->tanggal_pengembalian == null)
                                    <p>belum dikembalikan</p>
                                @else
                                    {{ $item->tanggal_pengembalian }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'menunggu')
                                ... 
                                @else
                                <a href="" class="btn btn-primary btn-sm">Kembalikan Buku</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="bs-toast toast fade show bg-success bottom-0 end-0 position-fixed m-3" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Berhasil</div>
                <small>sec ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif
@endsection
