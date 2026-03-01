<?php

namespace App\Http\Controllers;

use App\Mail\invitationMail;
use App\Models\Invitation;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class InvitationController extends Controller
{
    /**
     * Send an invitation email.
     */
    public function send(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $invitation = Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => Str::random(32),
            'status' => 'pending',
            'sent_at' => now(),
            'expired_at' => now()->addHours(24),
        ]);

        $url = URL::temporarySignedRoute(
            'invitation.accept',
            now()->addHours(24),
            ['token' => $invitation->token]
        );

        Mail::to($request->email)->send(new invitationMail($url, $colocation));

        return redirect()->route('colocation.index')->with('success', 'Invitation sent successfully!');
    }

    /**
     * Accept an invitation.
     */
    public function accept(Request $request, $token)
    {
        $invitation = Invitation::where('token', $token)
                        ->where('status', 'pending')
                        ->first();

        if (!$invitation) {
            return redirect()->route('colocation.index')->with('error', 'Invitation not found or already used.');
        }

        if ($invitation->isExpired()) {
            return redirect()->route('colocation.index')->with('error', 'This invitation has expired.');
        }

        // Guest: redirect to register with the email pre-filled
        if (auth()->guest()) {
            session(['pending_invite_token' => $token]);

            return redirect()->route('register', ['email' => $invitation->email])
                ->with('status', 'Please register to join the colocation.');
        }

        // Logged in: assign user to the colocation
        $user = auth()->user();

        // Soft-leave current colocation if any
        if ($user->colocation) {
            $user->colocations()->updateExistingPivot($user->colocation->id, ['left_at' => now()]);
        }

        $user->colocations()->syncWithoutDetaching([$invitation->colocation_id => ['role' => 'member']]);

        $invitation->update([
            'status' => 'accepted',
            'responded_at' => now(),
        ]);

        return redirect()->route('colocation.index')->with('success', 'You have joined the colocation!');
    }
}
