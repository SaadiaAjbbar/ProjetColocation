<?php

namespace App\Http\Controllers;

use App\Models\Adhesion;
use App\Models\Colocation;
use Illuminate\Http\Request;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $token = Str::random(40);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // envoyer email
            $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'colocation_id' => $colocation->id,
            'invite_par' => Auth::id(),
        ]);
            Mail::send('emails.invitation', ['colocation' => $colocation, 'token' => $token], function ($message) use ($request) {
                $message->to($request->email)->subject('Invitation Colocation');
            });

            return back()->with('success', 'Invitation envoyée');
        }

        $adherent = $user->adhesions()->whereNull('left_at')->exists();

        if ($adherent ) {
            return back()->with('error', 'Cet utilisateur est déjà membre de la colocation');
        }
        // envoyer email
            $invitation = Invitation::create([
                'email' => $request->email,
                'token' => $token,
                'colocation_id' => $colocation->id,
                'invite_par' => Auth::id(),
            ]);
        Mail::send('emails.invitation', ['colocation' => $colocation, 'token' => $token], function ($message) use ($request) {
            $message->to($request->email)->subject('Invitation Colocation');
        });

        return back()->with('success', 'Invitation envoyée');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->where('accepte', false)->firstOrFail();

        if (Auth::check()) {
            $invitation = Invitation::where('token', session('invitation_token'))->first();

            if ($invitation) {
                Adhesion::create([
                    'user_id' => Auth::user()->id,
                    'colocation_id' => $invitation->colocation_id,
                ]);

                $invitation->accepte = true;
                $invitation->save();

                session()->forget('invitation_token');
            }
        }

        session(['invitation_token' => $token]);

        return redirect()->route('register');
    }
}
