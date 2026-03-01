<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => User::count() === 0, // First registered user becomes admin
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Process pending invitation if the user registered via an invite link
        if ($token = session()->pull('pending_invite_token')) {
            $invitation = Invitation::where('token', $token)
                ->where('status', 'pending')
                ->first();

            if ($invitation && !$invitation->isExpired()) {
                $user->colocations()->attach($invitation->colocation_id, ['role' => 'member']);
                // $user->save(); // No longer need to save user as colocation_id is in pivot table

                $invitation->update([
                    'status' => 'accepted',
                    'responded_at' => now(),
                ]);

                return redirect(route('colocation.index', absolute: false))
                    ->with('success', 'Welcome! You have joined the colocation.');
            }
        }

        return redirect(route('colocation.index', absolute: false));
    }
}
