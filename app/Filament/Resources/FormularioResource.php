<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormularioResource\Pages;
use App\Filament\Resources\FormularioResource\RelationManagers;
use App\Models\Formulario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormularioResource extends Resource
{
    protected static ?string $model = Formulario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(25),
                Forms\Components\TextInput::make('placeholder')
                    ->required()
                    ->maxLength(25),
                Forms\Components\TextInput::make('identificador')
                    ->required()
                    ->maxLength(10),
                Forms\Components\ToggleButtons::make('requerido')
                    ->boolean()
                    ->grouped()
                    ->required(),
                Forms\Components\Select::make('tipo')
                    ->options([
                        1 => 'Corto',
                        2 => 'Largo',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('tipo_campo')
                    ->options([
                        'date' => 'Fecha',
                        'email' => 'Correo',
                        'number' => 'Número',
                        'tel' => 'Telefono',
                        'text' => 'Texto',
                        'url' => 'Web',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('orden')
                    ->required(),
                Forms\Components\ToggleButtons::make('activo')
                    ->boolean()
                    ->grouped()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('placeholder')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('identificador')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('tipo')
                //     ->searchable(),
                // Tables\Columns\IconColumn::make('requerido')
                //     ->boolean(),
                Tables\Columns\TextColumn::make('tipo_campo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('orden'),
                Tables\Columns\IconColumn::make('activo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListFormularios::route('/'),
            'create' => Pages\CreateFormulario::route('/create'),
            'edit' => Pages\EditFormulario::route('/{record}/edit'),
        ];
    }
}
