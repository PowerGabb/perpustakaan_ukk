<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function index(){

        $book = Buku::with(['category'])->get();

        return view('home', compact('book'));
    }
}
