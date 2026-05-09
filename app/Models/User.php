<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
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