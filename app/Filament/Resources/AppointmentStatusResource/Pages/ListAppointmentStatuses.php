<?php

namespace App\Filament\Resources\AppointmentStatusResource\Pages;

use App\Filament\Resources\AppointmentStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppointmentStatuses extends ListRecords
{
    protected static string $resource = AppointmentStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add New')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
