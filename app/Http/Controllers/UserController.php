<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['role'])->where('role_id', '!=', 1)->get();
        return view('admin.user.index', compact('users'));
    }
    public function create(){

        $role = Role::all();
        return view('admin.user.create', compact('role'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'username' => 'required|alpha_dash|unique:users',
            'nama_lengkap' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ],
    [
        'username.required' => 'Username tidak boleh kosong',
        'username.alpha_dash' => 'Username tidak boleh spasi',
        'username.unique' => 'Username sudah ada',
        'nama_lengkap.required' => 'Nama harus di isi',
        'email.required' => 'Email harus di isi',
        'email.unique' => 'Email sudah digunakan',
    ]);

    $useradd = User::create([
        'username' => $request->username,
        'nama_lengkap' => $request->nama_lengkap,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id,
    ]);

    return redirect('/user')->with('success', 'User berhasil di tambahkan');
    }
    

    public function acc($id){
        $user = User::find($id)->update([
            'role_id' => 2,
        ]);

        return redirect('/user')->with('success', 'User berhasil di acc');
    }

    public function down($id){
        $user = User::find($id)->update([
            'role_id' => 3,
        ]);

        return redirect('/user')->with('success', 'User berhasil di down');
    }

    public function listPinjam(){
        $pinjaman = Peminjaman::with(['user', 'buku'])->where('user_id', Auth::user()->id)->get();
        return view('user.daftar-pinjam', compact('pinjaman'));
    }
}
