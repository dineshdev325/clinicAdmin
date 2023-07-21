<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultationResource\Pages;
use App\Filament\Resources\ConsultationResource\RelationManagers;
use App\Models\Consultation;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Select::make('doctors_id')
                    ->relationship('doctor', 'name')
                    ->required(),
                    Select::make('patient_details_id')
                    ->relationship('patient', 'full_name')
                    ->required(),
                    Textarea::make('health_concerns')
                    ->required()
                   ->rows(5)
                   ->cols(10)
                   ->columnSpan(2),
                    DateTimePicker::make('consultation_date_time'),
                    Toggle::make('is_paid')
                    ->onIcon('heroicon-s-currency-rupee')
                    ->offIcon('heroicon-o-currency-rupee')
                    ->inline(false)
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('doctor.name'),
                TextColumn::make('patient.full_name'),
                TextColumn::make('consultation_date_time'),
                TextColumn::make('health_concerns')
                ->limit(10),
                ToggleColumn::make('is_paid')
                     ->onIcon('heroicon-s-currency-rupee')
                    ->offIcon('heroicon-o-currency-rupee')
                    ->inline(false)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }    
}
