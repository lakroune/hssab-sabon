<?php

namespace App\Filament\Admin\Resources\Debts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DebtForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('debtor_id')
                    ->relationship('debtor', 'name')
                    ->required(),
                Select::make('creditor_id')
                    ->relationship('creditor', 'name')
                    ->required(),
                Select::make('colocation_id')
                    ->relationship('colocation', 'name')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
            ]);
    }
}
