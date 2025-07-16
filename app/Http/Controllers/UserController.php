<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->get('role'));
        }

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->get('date'));
        }

        $users = $query->latest()->paginate(10);
        $users->appends($request->query());

        // Statistics
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'masyarakat')->count();
        $todayUsers = User::whereDate('created_at', today())->count();

        return view('backend.admin.users.index', compact(
            'users',
            'totalUsers',
            'adminCount',
            'userCount',
            'todayUsers'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,masyarakat',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');
            $data['avatar'] = $avatarPath;
        }

        User::create($data);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,masyarakat',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');
            $data['avatar'] = $avatarPath;
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting current user
        if ($user->id == Auth::id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Delete avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * Delete multiple users
     */
    public function multipleDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        $currentUserId = Auth::id();

        // Remove current user from deletion list
        $ids = array_filter($ids, function ($id) use ($currentUserId) {
            return $id != $currentUserId;
        });

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pengguna yang valid untuk dihapus.'
            ], 400);
        }

        $users = User::whereIn('id', $ids)->get();

        // Delete avatars
        foreach ($users as $user) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        $deleted = User::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted} pengguna."
        ]);
    }
}
