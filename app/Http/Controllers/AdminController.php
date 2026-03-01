<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Colocation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalColocations = Colocation::count();
        $users = User::paginate(10);

        return view('admin.dashboard', compact('totalUsers', 'totalColocations', 'users'));
    }

    public function ban(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Cannot ban an administrator.');
        }

        $user->update([
            'status' => 'Banned',
            'banned_at' => now(),
        ]);

        return back()->with('success', "User {$user->name} has been banned.");
    }

    public function unban(User $user)
    {
        $user->update([
            'status' => 'active',
            'banned_at' => null,
        ]);

        return back()->with('success', "User {$user->name} has been unbanned.");
    }
}
