<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
     public function index()
     {
          $users = User::admins()->orderBy('created_at', 'desc')->paginate(10);
          return view('admin.users.index', compact('users'));
     }

     public function create()
     {
          return view('admin.users.create');
     }

     public function store(Request $request)
     {
          $validator = Validator::make($request->all(), [
               'name' => 'required|string|max:255',
               'email' => 'required|string|email|max:255|unique:users',
               'password' => 'required|string|min:8|confirmed',
               'role' => 'required|in:admin,super_admin',
               'is_active' => 'boolean'
          ]);

          if ($validator->fails()) {
               return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
          }

          User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
               'role' => $request->role,
               'is_active' => $request->has('is_active'),
               'email_verified_at' => now(), // Auto verify for admin created users
          ]);

          return redirect()->route('admin.users.index')
               ->with('success', 'Pengguna berhasil ditambahkan.');
     }

     public function show(User $user)
     {
          return view('admin.users.show', compact('user'));
     }

     public function edit(User $user)
     {
          return view('admin.users.edit', compact('user'));
     }

     public function update(Request $request, User $user)
     {
          $validator = Validator::make($request->all(), [
               'name' => 'required|string|max:255',
               'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
               'password' => 'nullable|string|min:8|confirmed',
               'role' => 'required|in:admin,super_admin',
               'is_active' => 'boolean'
          ]);

          if ($validator->fails()) {
               return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
          }

          $updateData = [
               'name' => $request->name,
               'email' => $request->email,
               'role' => $request->role,
               'is_active' => $request->has('is_active'),
          ];

          if ($request->filled('password')) {
               $updateData['password'] = Hash::make($request->password);
          }

          $user->update($updateData);

          return redirect()->route('admin.users.index')
               ->with('success', 'Pengguna berhasil diperbarui.');
     }

     public function destroy(User $user)
     {
          // Prevent deleting the last super admin
          if ($user->isSuperAdmin()) {
               $superAdminCount = User::where('role', 'super_admin')->where('is_active', true)->count();
               if ($superAdminCount <= 1) {
                    return redirect()->route('admin.users.index')
                         ->with('error', 'Tidak dapat menghapus Super Admin terakhir.');
               }
          }

          // Prevent self-deletion
          if ($user->id === auth()->id()) {
               return redirect()->route('admin.users.index')
                    ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
          }

          $user->delete();

          return redirect()->route('admin.users.index')
               ->with('success', 'Pengguna berhasil dihapus.');
     }

     public function toggleStatus(User $user)
     {
          // Prevent deactivating the last super admin
          if ($user->isSuperAdmin() && $user->is_active) {
               $activeSuperAdminCount = User::where('role', 'super_admin')->where('is_active', true)->count();
               if ($activeSuperAdminCount <= 1) {
                    return redirect()->route('admin.users.index')
                         ->with('error', 'Tidak dapat menonaktifkan Super Admin terakhir.');
               }
          }

          // Prevent self-deactivation
          if ($user->id === auth()->id()) {
               return redirect()->route('admin.users.index')
                    ->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
          }

          $user->update(['is_active' => !$user->is_active]);

          $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
          return redirect()->route('admin.users.index')
               ->with('success', "Pengguna berhasil {$status}.");
     }
}
