<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        // Search by keyword in description or user_name
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%");
            });
        }

        // Filter Action Type
        if ($request->filled('action') && $request->input('action') !== 'all') {
            $query->where('action', $request->input('action'));
        }

        // Filter User
        if ($request->filled('user_id') && $request->input('user_id') !== 'all') {
            $query->where('user_id', $request->input('user_id'));
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        // Unique action types for filter
        $actionTypes = ActivityLog::select('action')->distinct()->pluck('action');
        $admins = User::whereIn('role', ['owner', 'partner', 'super_admin'])->orderBy('name')->get();

        $totalLogs = ActivityLog::count();
        $todayLogs = ActivityLog::whereDate('created_at', today())->count();

        return view('admin.activity_logs.index', compact(
            'logs',
            'actionTypes',
            'admins',
            'totalLogs',
            'todayLogs'
        ));
    }

    public function clear(Request $request)
    {
        if (!Auth::user()->isOwner()) {
            return back()->with('error', 'Hanya Owner Utama yang dapat menghapus / membersihkan riwayat log aktivitas!');
        }

        $mode = $request->input('mode', 'old');

        if ($mode === 'all') {
            ActivityLog::truncate();
            $msg = 'Seluruh riwayat log aktivitas berhasil dibersihkan.';
        } else {
            $deleted = ActivityLog::where('created_at', '<', now()->subDays(30))->delete();
            $msg = "Log aktivitas yang lebih lama dari 30 hari berhasil dibersihkan ({$deleted} data dihapus).";
        }

        ActivityLog::record(
            'CLEAR_LOGS',
            "Owner Utama (" . Auth::user()->name . ") membersihkan riwayat log aktivitas sistem ({$mode})."
        );

        return back()->with('success', $msg);
    }
}
