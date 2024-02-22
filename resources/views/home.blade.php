@extends('layouts.index')
@section('title', 'Home Page')
@section('content')
<div class="row">
    @forelse ($book as $item)
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">{{$item->judul}}</h5>
            <h6 class="card-subtitle text-muted">{{$item->category->nama_kategori}}</h6>
            <img class="img-fluid d-flex mx-auto my-4" src="{{asset('storage/cover/'. $item->image)}}" alt="Card image cap">
            <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
            @if (Auth::user())
            <a href="/pinjam-buku/{{$item->id}}" class="card-link">Pinjam</a>
            <a href="" class="card-link">Tambah koleksi</a>
            @else
            <a href="/login" class="card-link">Login</a>
            @endif
          </div>
        </div>
      </div>
    @empty
        
    @endforelse
</div>
@endsection