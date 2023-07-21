<?php

namespace App\Filament\Resources\PatientDetailsResource\Pages;

use App\Filament\Resources\PatientDetailsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientDetails extends EditRecord
{
    protected static string $resource = PatientDetailsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
       protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
