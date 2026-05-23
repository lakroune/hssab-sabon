<?php

namespace App\Filament\Admin\Resources\Colocations\Pages;

use App\Filament\Admin\Resources\Colocations\ColocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListColocations extends ListRecords
{
    protected static string $resource = ColocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
