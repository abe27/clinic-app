<?php

namespace App\Filament\Resources\PatientDetailResource\Pages;

use App\Filament\Resources\PatientDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientDetail extends EditRecord
{
    protected static string $resource = PatientDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
