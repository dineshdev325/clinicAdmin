<?php

namespace App\Filament\Resources\ConsultationResource\Pages;

use App\Filament\Resources\ConsultationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsultation extends EditRecord
{
    protected static string $resource = ConsultationResource::class;

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
