<?php

namespace App\Filament\Resources\TimeSlotResource\Pages;

use App\Filament\Resources\TimeSlotResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimeSlot extends EditRecord
{
    protected static string $resource = TimeSlotResource::class;

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
