<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){

        $buku = Buku::with(['category'])->get();
        return view('admin.book.index', compact('buku'));
    }

    public function create(){

        $category = KategoriBuku::all();
        return view('admin.book.create', compact('category'));
    }

    public function store(Request $request){
        $request->validate([
            'tahun_terbit' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'cover' => 'required|mimes:png,jpg,jpeg,jfif',
        ]);

        $extension = $request->file('cover')->extension();
        $nameimg = $request->judul . '-' . now()->format('Y-m-d') . '.' . $extension;
        $request->file('cover')->storeAs('public/cover/', $nameimg);

        $books = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'category_id' => $request->category,
            'penerbit' => $request->penerbit,
            'image' => $nameimg,
            'tahun_terbit' => $request->tahun_terbit
        ]);

        return redirect('/buku')->with('success', 'Buku berhasil di tambahkan');


    }

    public function edit($id){
        $book = Buku::find($id);
        $category = KategoriBuku::all();
        return view('admin.book.edit', compact('book', 'category'));
    }

    public function update(Request $request){
        $request->validate([
            'tahun_terbit' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
        ]);


        $bukufoto = Buku::find($request->id);
        
        if ($request->cover == null) {
            $nameimg = $bukufoto->image;
        }else{
            $extension = $request->file('cover')->extension();
            $nameimg = $request->judul . '-' . now()->format('Y-m-d') . '.' . $extension;
            $request->file('cover')->storeAs('public/cover/', $nameimg);
        }
            
        $books = Buku::find($request->id)->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'category_id' => $request->category,
            'penerbit' => $request->penerbit,
            'image' => $nameimg,
            'tahun_terbit' => $request->tahun_terbit
        ]);

        return redirect('/buku')->with('success', 'Buku berhasil di update');
    }

    public function destroy(Request $request){
        $hapusbuku = Buku::find($request->id)->delete();
        return redirect('/buku')->with('success', 'Buku berhasil di hapus');
    }
}
