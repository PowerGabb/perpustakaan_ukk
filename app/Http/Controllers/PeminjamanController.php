<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function pinjam($id){
        $pinjam = Peminjaman::create([
            'user_id' => Auth::user()->id,
            'buku_id' => $id,
            'tanggal_peminjaman' => now()->format('Y-m-d')
        ]);
        return redirect('/daftar-pinjam')->with('success', 'Meminjam buku berhasil');
    }
}
