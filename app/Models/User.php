<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
}