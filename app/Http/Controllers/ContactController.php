<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('legal.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['required', 'in:bug,feature,account,legal,other'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required'    => 'Le nom est obligatoire.',
            'email.required'   => "L'adresse email est obligatoire.",
            'email.email'      => "L'adresse email n'est pas valide.",
            'subject.required' => 'Veuillez choisir un sujet.',
            'subject.in'       => 'Sujet invalide.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Le message doit contenir au moins 10 caractères.',
            'message.max'      => 'Le message ne peut pas dépasser 2000 caractères.',
        ]);

        $subjectLabels = [
            'bug'     => '🐛 Bug signalé',
            'feature' => '💡 Suggestion',
            'account' => '👤 Problème de compte',
            'legal'   => '⚖️ Question légale',
            'other'   => '✉️ Autre',
        ];

        $subjectLabel = $subjectLabels[$validated['subject']] ?? $validated['subject'];

        // Mail à l'équipe
        Mail::raw(
            "Nouveau message via Hsab Sabon\n\n"
                . "De : {$validated['name']} <{$validated['email']}>\n"
                . "Sujet : {$subjectLabel}\n"
                . "---\n\n"
                . $validated['message'],
            function ($mail) use ($validated, $subjectLabel) {
                $mail->to(config('mail.contact_address', 'eazy.coloc@gmail.com'))
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject("[Hsab Sabon] {$subjectLabel} — {$validated['name']}");
            }
        );

        // Mail de confirmation à l'expéditeur
        Mail::raw(
            "Salam {$validated['name']},\n\n"
                . "On a bien reçu ton message et on te répond dans les 48h ouvrées.\n\n"
                . "Ton message :\n---\n{$validated['message']}\n---\n\n"
                . "L'équipe Hsab Sabon 🏠",
            function ($mail) use ($validated) {
                $mail->to($validated['email'], $validated['name'])
                    ->subject("On a bien reçu ton message · Hsab Sabon");
            }
        );

        return redirect()
            ->route('contact.index')
            ->with('success', 'Message envoyé ! On te répond dans les 48h. 🎉');
    }
}
