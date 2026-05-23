<?php

namespace App\Filament\Admin\Resources\Transactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('type')
                    ->options(['shared' => 'Shared', 'p2p' => 'P2p'])
                    ->required(),
                Select::make('payer_id')
                    ->relationship('payer', 'name')
                    ->required(),
                Select::make('receiver_id')
                    ->relationship('receiver', 'name'),
                Select::make('colocation_id')
                    ->relationship('colocation', 'name')
                    ->required(),
                TextInput::make('category'),
                Toggle::make('is_settled')
                    ->required(),
            ]);
    }
}
