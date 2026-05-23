<?php

namespace App\Filament\Admin\Resources\Colocations;

use App\Filament\Admin\Resources\Colocations\Pages\CreateColocation;
use App\Filament\Admin\Resources\Colocations\Pages\EditColocation;
use App\Filament\Admin\Resources\Colocations\Pages\ListColocations;
use App\Filament\Admin\Resources\Colocations\Pages\ViewColocation;
use App\Filament\Admin\Resources\Colocations\Schemas\ColocationForm;
use App\Filament\Admin\Resources\Colocations\Schemas\ColocationInfolist;
use App\Filament\Admin\Resources\Colocations\Tables\ColocationsTable;
use App\Models\Colocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ColocationResource extends Resource
{
    protected static ?string $model = Colocation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ColocationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ColocationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ColocationsTable::configure($table);
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
            'index' => ListColocations::route('/'),
            'create' => CreateColocation::route('/create'),
            'view' => ViewColocation::route('/{record}'),
            'edit' => EditColocation::route('/{record}/edit'),
        ];
    }
}
