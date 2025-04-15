<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminManagementController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = User::with('roles')->get();
        return view('superadmin.index', compact('users'));
    }

    // Edit role user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('superadmin.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Cabut semua role lalu tetapkan baru jika ada
        $user->roles()->detach();
        if ($request->filled('role_id')) {
            $user->roles()->attach($request->role_id);
        }

        $user->save();

        return redirect()->route('dapurSuperadmin')->with('success', 'Admin berhasil diperbarui.');
    }


    // Hapus user
    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus diri sendiri!');
        }
        
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}