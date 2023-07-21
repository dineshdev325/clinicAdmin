<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientDetailsResource\Pages;
use App\Filament\Resources\PatientDetailsResource\RelationManagers;
use App\Models\PatientDetails;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientDetailsResource extends Resource
{
    protected static ?string $model = PatientDetails::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                TextInput::make('full_name')
                ->required()
                ->alpha(),
                TextInput::make('phone_number')
                ->required(),
                TextInput::make('email')
                ->email()
                ->required(),
  ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                ->searchable()
                ->sortable(),
                TextColumn::make('phone_number'),
                TextColumn::make('email')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientDetails::route('/'),
            'create' => Pages\CreatePatientDetails::route('/create'),
            'edit' => Pages\EditPatientDetails::route('/{record}/edit'),
        ];
    }    
}
