<?php

namespace App\Filament\Admin\Resources\Debts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DebtInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('debtor.name')
                    ->label('Debtor'),
                TextEntry::make('creditor.name')
                    ->label('Creditor'),
                TextEntry::make('colocation.name')
                    ->label('Colocation'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
