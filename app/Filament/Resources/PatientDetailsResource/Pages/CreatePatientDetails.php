<?php

namespace App\Filament\Resources\PatientDetailsResource\Pages;

use App\Filament\Resources\PatientDetailsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatientDetails extends CreateRecord
{
    protected static string $resource = PatientDetailsResource::class;
       protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
