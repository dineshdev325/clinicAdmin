<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimeSlotResource\Pages;
use App\Filament\Resources\TimeSlotResource\RelationManagers;
use App\Models\TimeSlot;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimeSlotResource extends Resource
{
    protected static ?string $model = TimeSlot::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {


        //CREATE A TIMESLOT
        $timeSlots = array();
        $startTime = strtotime('05:30:00');
        $endTime = strtotime('23:30:00');
        for (
            $start = $startTime;
            $start <= $endTime;
            $start = $start + 30 * 60
        ) {
            $timeSlots[date('H:i:s', $start)] = date('h:i A', $start);
            //  array_push($timeSlots, $start);
        }
        // dd($timeSlots);
        // $timeSlots=$this->timeSlots;
        return $form
            ->schema([
                //
                Card::make()
                    ->schema([
                        Select::make('slots_id')
                            ->relationship('slots', 'id')
                            ->preload()
                            ->searchable()
                            ->required(),
                        Select::make('time')
                            ->options($timeSlots)
                            ->required(),
                        Toggle::make('is_available')
                            ->onIcon('heroicon-s-lightning-bolt')
                            ->offIcon('heroicon-s-clock')
                            ->inline(false)
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slots.id')
                ,   
                TextColumn::make('time')
                    ->dateTime('h:i A')
                    ->sortable(),
                ToggleColumn::make('is_available')
                    ->onIcon('heroicon-s-lightning-bolt')
                    ->offIcon('heroicon-s-clock')
            ])
            ->filters([
                //IsAvailable
                Filter::make('is_available')
                    ->query(fn (Builder $query): Builder => $query->where('is_available', true)),
            // DATE
             SelectFilter::make('slots.date')
             ->relationship('slots','date'),
                //DOCTOR
            //      SelectFilter::make('slots.doctor')
            //  ->relationship('slots.doctor','name')
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
            'index' => Pages\ListTimeSlots::route('/'),
            'create' => Pages\CreateTimeSlot::route('/create'),
            'edit' => Pages\EditTimeSlot::route('/{record}/edit'),
        ];
    }
}
