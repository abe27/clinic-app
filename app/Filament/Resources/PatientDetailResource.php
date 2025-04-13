<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientDetailResource\Pages;
use App\Filament\Resources\PatientDetailResource\RelationManagers;
use App\Models\Patient;
use App\Models\PatientDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientDetailResource extends Resource
{
    protected static ?string $model = PatientDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->searchable()
                    ->required()
                    ->options(
                        Patient::query()
                            ->select(['id', 'first_name', 'last_name'])
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [$item['id'] => "{$item['first_name']} {$item['last_name']}"];
                            })
                            ->toArray()
                    ),
                Forms\Components\Textarea::make('remark')
                    ->required()
                    ->columnSpanFull(),
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
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.last_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.tel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.gender.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.hn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.pass_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.card.number')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPatientDetails::route('/'),
            // 'create' => Pages\CreatePatientDetail::route('/create'),
            // 'edit' => Pages\EditPatientDetail::route('/{record}/edit'),
        ];
    }
}
