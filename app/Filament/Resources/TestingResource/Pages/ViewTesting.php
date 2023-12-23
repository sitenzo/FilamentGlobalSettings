<?php

namespace App\Filament\Resources\TestingResource\Pages;

use App\Filament\Resources\TestingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTesting extends ViewRecord
{
    protected static string $resource = TestingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label(false)
                ->icon('heroicon-m-pencil-square')
                ->iconButton(),
        ];
    }

}
