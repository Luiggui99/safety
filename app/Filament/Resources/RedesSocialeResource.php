<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedesSocialeResource\Pages;
use App\Filament\Resources\RedesSocialeResource\RelationManagers;
use App\Models\RedesSociale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RedesSocialeResource extends Resource
{
    protected static ?string $model = RedesSociale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(25),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('icono')
                    ->options([
                        'bx bxl-facebook' => 'Facebook',
                        'bx bxl-instagram' => 'Instagram',
                        'bx bxl-linkedin' => 'Linkedin',
                        'bx bxl-whatsapp' => 'WhatsApp',
                        'bx bxl-youtube' => 'YouTube',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Toggle::make('activo')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icono')
                    ->searchable(),
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
            'index' => Pages\ListRedesSociales::route('/'),
            'create' => Pages\CreateRedesSociale::route('/create'),
            'edit' => Pages\EditRedesSociale::route('/{record}/edit'),
        ];
    }
}
