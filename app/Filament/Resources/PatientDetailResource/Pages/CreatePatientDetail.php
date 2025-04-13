<?php

namespace App\Filament\Resources\PatientDetailResource\Pages;

use App\Filament\Resources\PatientDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatientDetail extends CreateRecord
{
    protected static string $resource = PatientDetailResource::class;
}
