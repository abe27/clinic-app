<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\FiltersLayout;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->searchable()
                    ->columnSpanFull()
                    ->required()
                    ->options(Patient::all()->mapWithKeys(function ($patient) {
                        return [$patient->id => $patient->first_name . ' ' . $patient->last_name];
                    })),
                Forms\Components\DateTimePicker::make('appointment_date')
                    ->required(),
                Forms\Components\Select::make('status_id')
                    ->label('Status')
                    ->required()
                    ->options(AppointmentStatus::all()->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('patient.first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.card.number')
                    ->label('Card ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('appointment_date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.name')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('appointment_date')
                    ->label('Appointment Date')
                    ->form([
                        Forms\Components\DatePicker::make('date')
                            ->date()
                            ->required(),
                    ])
                    ->query(function ($query, $data) {
                        return $query
                            ->when(
                                $data['date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('appointment_date', '=', $date),
                            );
                    })
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(1)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAppointments::route('/'),
            // 'create' => Pages\CreateAppointment::route('/create'),
            // 'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
