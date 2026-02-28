<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;

use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        if ($colocation->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'email' => 'required|email'
        ]);

        $token = Str::random(40);

        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'colocation_id' => $colocation->id,
            'invite_par' => Auth::id()
        ]);

        // envoyer email
        Mail::raw(
            "Vous avez été invité à rejoindre une colocation. Cliquez ici : "
                . route('admin.invitations.accept', $token),
            function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Invitation Colocation');
            }
        );

        return back()->with('success', 'Invitation envoyée');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('accepte', false)
            ->firstOrFail();


        session(['invitation_token' => $token]);

        return redirect()->route('register');
    }
}
