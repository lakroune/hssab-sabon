<?php

namespace App\Filament\Admin\Resources\Colocations\Pages;

use App\Filament\Admin\Resources\Colocations\ColocationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewColocation extends ViewRecord
{
    protected static string $resource = ColocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
