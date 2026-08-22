<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount(['wishlists', 'activityLogs']);

        // Search by name or email or phone
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter Role
        if ($request->filled('role') && $request->input('role') !== 'all') {
            $query->where('role', $request->input('role'));
        }

        // Filter Status (active / banned)
        if ($request->filled('status') && $request->input('status') !== 'all') {
            if ($request->input('status') === 'banned') {
                $query->where('is_banned', true);
            } else {
                $query->where('is_banned', false);
            }
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Statistics
        $totalUsers = User::count();
        $totalOwners = User::whereIn('role', ['owner', 'super_admin'])->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalResellers = User::where('role', 'reseller')->count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalBanned = User::where('is_banned', true)->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalOwners',
            'totalAdmins',
            'totalResellers',
            'totalCustomers',
            'totalBanned'
        ));
    }

    public function updateRole(Request $request, $id)
    {
        $targetUser = User::findOrFail($id);
        $currentUser = Auth::user();

        // Only Owner can change roles to/from Owner/Admin
        if (!$currentUser->isOwner() && ($targetUser->isOwner() || in_array($request->input('role'), ['owner', 'admin']))) {
            return back()->with('error', 'Hanya Owner Utama yang memiliki hak akses untuk mengubah role Admin atau Owner!');
        }

        $validated = $request->validate([
            'role' => 'required|in:user,reseller,admin,owner',
        ]);

        $oldRole = $targetUser->role;
        $targetUser->role = $validated['role'];
        $targetUser->save();

        ActivityLog::record(
            'CHANGE_ROLE',
            "Mengubah hak akses pengguna '{$targetUser->name}' ({$targetUser->email}) dari [{$oldRole}] menjadi [{$targetUser->role}].",
            [
                'target_user_id' => $targetUser->id,
                'old_role' => $oldRole,
                'new_role' => $targetUser->role,
            ]
        );

        return back()->with('success', "Role pengguna {$targetUser->name} berhasil diubah menjadi " . strtoupper($targetUser->role) . "!");
    }

    public function toggleBan(Request $request, $id)
    {
        $targetUser = User::findOrFail($id);
        $currentUser = Auth::user();

        if ($targetUser->isOwner()) {
            return back()->with('error', 'Akun Owner Utama tidak dapat diblokir!');
        }

        if ($targetUser->id === $currentUser->id) {
            return back()->with('error', 'Anda tidak dapat memblokir akun Anda sendiri!');
        }

        $isBanning = !$targetUser->is_banned;
        $reason = $request->input('ban_reason', 'Aktivitas mencurigakan / melanggar aturan toko ALzis STURR.');

        $targetUser->is_banned = $isBanning;
        $targetUser->ban_reason = $isBanning ? $reason : null;
        $targetUser->save();

        $actionName = $isBanning ? 'BAN_USER' : 'UNBAN_USER';
        $desc = $isBanning 
            ? "Memblokir / menonaktifkan pengguna '{$targetUser->name}' ({$targetUser->email}) dengan alasan: {$reason}"
            : "Membuka blokir pengguna '{$targetUser->name}' ({$targetUser->email}) dan mengaktifkan kembali akunnya.";

        ActivityLog::record($actionName, $desc, [
            'target_user_id' => $targetUser->id,
            'reason' => $reason,
        ]);

        $statusMsg = $isBanning ? "Pengguna {$targetUser->name} berhasil diblokir / dinonaktifkan." : "Blokir pengguna {$targetUser->name} berhasil dibuka!";
        return back()->with('success', $statusMsg);
    }

    public function updatePassword(Request $request, $id)
    {
        $targetUser = User::findOrFail($id);
        $currentUser = Auth::user();

        if (!$currentUser->isOwner() && $targetUser->isOwner()) {
            return back()->with('error', 'Hanya Owner Utama yang dapat mereset kata sandi sesama Owner!');
        }

        $validated = $request->validate([
            'new_password' => 'required|string|min:6',
        ]);

        $targetUser->password = Hash::make($validated['new_password']);
        $targetUser->save();

        ActivityLog::record(
            'RESET_PASSWORD',
            "Mereset kata sandi akun pengguna '{$targetUser->name}' ({$targetUser->email}).",
            ['target_user_id' => $targetUser->id]
        );

        return back()->with('success', "Kata sandi untuk pengguna {$targetUser->name} berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $targetUser = User::findOrFail($id);
        $currentUser = Auth::user();

        if ($targetUser->isOwner()) {
            return back()->with('error', 'Akun Owner Utama tidak dapat dihapus!');
        }

        if ($targetUser->id === $currentUser->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $userName = $targetUser->name;
        $userEmail = $targetUser->email;

        // Clean up wishlists
        $targetUser->wishlists()->delete();
        $targetUser->delete();

        ActivityLog::record(
            'DELETE_USER',
            "Menghapus pengguna '{$userName}' ({$userEmail}) dari database.",
            ['deleted_user_email' => $userEmail]
        );

        return back()->with('success', "Pengguna [{$userName}] berhasil dihapus dari sistem.");
    }
}
