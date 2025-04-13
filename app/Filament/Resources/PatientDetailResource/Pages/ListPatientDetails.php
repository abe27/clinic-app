<?php

namespace App\Filament\Resources\PatientDetailResource\Pages;

use App\Filament\Resources\PatientDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientDetails extends ListRecords
{
    protected static string $resource = PatientDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add New')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
