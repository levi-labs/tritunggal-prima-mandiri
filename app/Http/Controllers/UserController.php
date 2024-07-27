<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Halaman Users';
        $data  = User::all();
        return view('pages.user.index', compact('title', 'data'));
    }
    public function create()
    {
        $title = 'Halaman Tambah Users';
        return view('pages.user.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        try {
            User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
            return redirect()->route('user.index')->with('success', 'Data User Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(User $user)
    {
        $title = 'Halaman Edit Users';
        return view('pages.user.edit', compact('title',  'user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);
        try {

            $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'role' => $request->role,
            ]);
            return redirect()->route('user.index')->with('success', 'Data User Berhasil Diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(User $user)
    {

        $user->delete();
        return redirect()->back()->with('success', 'Data User Berhasil Dihapus');
    }

    public function resetPassword(User $user)
    {

        try {
            $user->update([
                'password' => bcrypt($user->username),
            ]);
            return redirect()->back()->with('success', 'Password Berhasil Direset menjadi ' . $user->username);
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function ubahPassword()
    {
        $title = 'Ubah Password';
        return view('pages.user.ubah-password', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
        ]);
        $user = User::find(auth()->user()->id);
        if (Hash::check($request->password_lama, $user->password)) {
            $user->update([
                'password' => bcrypt($request->password_baru),
            ]);
            return redirect()->back()->with('success', 'Password Berhasil Diubah');
        }
        return redirect()->back()->with('error', 'Password lama tidak sesuai');
    }
}
