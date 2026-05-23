<?php

namespace App\Filament\Admin\Resources\Debts;

use App\Filament\Admin\Resources\Debts\Pages\CreateDebt;
use App\Filament\Admin\Resources\Debts\Pages\EditDebt;
use App\Filament\Admin\Resources\Debts\Pages\ListDebts;
use App\Filament\Admin\Resources\Debts\Pages\ViewDebt;
use App\Filament\Admin\Resources\Debts\Schemas\DebtForm;
use App\Filament\Admin\Resources\Debts\Schemas\DebtInfolist;
use App\Filament\Admin\Resources\Debts\Tables\DebtsTable;
use App\Models\Debt;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DebtResource extends Resource
{
    protected static ?string $model = Debt::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DebtForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DebtInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DebtsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDebts::route('/'),
            'create' => CreateDebt::route('/create'),
            'view' => ViewDebt::route('/{record}'),
            'edit' => EditDebt::route('/{record}/edit'),
        ];
    }
}
