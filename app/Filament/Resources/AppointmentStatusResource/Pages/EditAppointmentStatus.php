<?php

namespace App\Filament\Resources\AppointmentStatusResource\Pages;

use App\Filament\Resources\AppointmentStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppointmentStatus extends EditRecord
{
    protected static string $resource = AppointmentStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
