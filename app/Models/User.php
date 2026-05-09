<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function colocations(): BelongsToMany
    {
        return $this->belongsToMany(Colocation::class)->withPivot('role')->withTimestamps();
    }

    public function paidTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'payer_id');
    }

    public function receivedTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }

    public function debtsAsDebtor(): HasMany
    {
        return $this->hasMany(Debt::class, 'debtor_id');
    }

    public function debtsAsCreditor(): HasMany
    {
        return $this->hasMany(Debt::class, 'creditor_id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new class extends VerifyEmail {
            public function toMail($notifiable)
            {
                $verificationUrl = $this->verificationUrl($notifiable);

                return (new MailMessage)
                    ->subject('Vérification de votre compte - HSAB SABON')
                    ->greeting('Bonjour ' . $notifiable->name . '!')
                    ->line('Merci de vous être inscrit sur HSAB SABON. Nous sommes ravis de vous compter parmi nous.')
                    ->line('Veuillez cliquer sur le bouton ci-dessous pour confirmer votre adresse e-mail et activer votre accès au Ledger.')
                    ->action('Vérifier mon compte', $verificationUrl)
                    ->line('Si vous n\'avez pas créé de compte, aucune action supplémentaire n\'est requise.')
                    ->salutation('Cordialement, L\'équipe HSAB SABON');
            }
        });
    }
}
