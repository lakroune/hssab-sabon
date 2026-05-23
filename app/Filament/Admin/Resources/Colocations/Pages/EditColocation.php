<?php

namespace App\Filament\Admin\Resources\Colocations\Pages;

use App\Filament\Admin\Resources\Colocations\ColocationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditColocation extends EditRecord
{
    protected static string $resource = ColocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
