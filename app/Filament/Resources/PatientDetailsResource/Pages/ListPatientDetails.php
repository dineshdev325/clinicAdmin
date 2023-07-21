<?php

namespace App\Filament\Resources\PatientDetailsResource\Pages;

use App\Filament\Resources\PatientDetailsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientDetails extends ListRecords
{
    protected static string $resource = PatientDetailsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
