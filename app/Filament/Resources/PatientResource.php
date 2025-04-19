<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Card;
use App\Models\Gender;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar')
                    ->hiddenLabel()
                    ->avatar()
                    ->alignCenter()
                    ->columnSpanFull()
                    ->directory('patients')
                    ->visibility('public'),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->columnStart(1),
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\TextInput::make('tel')
                    ->required()
                    ->tel(),
                Forms\Components\Select::make('gender_id')
                    ->required()
                    ->options(Gender::all()->pluck('name', 'id')),
                Forms\Components\DatePicker::make('birth_date')
                    ->required(),
                Forms\Components\TextInput::make('hn')
                    ->required(),
                Forms\Components\TextInput::make('pass_id')
                    ->label('Pass ID')
                    ->required(),
                Forms\Components\Select::make('card_id')
                    ->label('Card ID')
                    ->searchable()
                    ->options(Card::all()->pluck('number', 'id'))
                    ->disabled()
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('card_id')
                    ->label('Card ID')
                    ->hiddenOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_id')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('')
                    ->circular(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date('d-m-Y')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pass_id')
                    ->label('Pass ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('card.number')
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d-m-Y H:s:i')
                    ->color('success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date('d-m-Y H:s:i')
                    ->color('danger')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gender_id')
                    ->label('Gender')
                    ->options(Gender::all()->pluck('name', 'id')),
            ])
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
            'index' => Pages\ListPatients::route('/'),
            // 'create' => Pages\CreatePatient::route('/create'),
            // 'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
