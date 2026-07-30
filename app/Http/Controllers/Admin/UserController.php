<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function toggleRole($id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak dapat mengubah role Anda sendiri.');
        }

        $user = User::findOrFail($id);
        $newRole = $user->role === 'admin' ? 'user' : 'admin';
        $user->update([
            'role' => $newRole,
        ]);

        return back()->with('success', 'Role user berhasil diubah menjadi ' . $newRole . '.');
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
