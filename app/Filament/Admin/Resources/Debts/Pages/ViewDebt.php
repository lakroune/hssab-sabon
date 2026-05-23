<?php

namespace App\Filament\Admin\Resources\Debts\Pages;

use App\Filament\Admin\Resources\Debts\DebtResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDebt extends ViewRecord
{
    protected static string $resource = DebtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
