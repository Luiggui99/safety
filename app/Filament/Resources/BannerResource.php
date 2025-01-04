<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('texto_principal')
                    ->required()
                    ->maxLength(50)
                    ->hint('Máximo 50 caracteres')
                    ->hintColor('info'),
                Forms\Components\TextInput::make('texto_secundario')
                    ->required()
                    ->maxLength(50)
                    ->hint('Máximo 50 caracteres')
                    ->hintColor('info'),
                Forms\Components\TextInput::make('imagen_alt')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('boton_texto')
                    ->maxLength(15),
                Forms\Components\TextInput::make('boton_icono')
                    ->maxLength(15),
                Forms\Components\TextInput::make('boton_url')
                    ->maxLength(255),
                Forms\Components\Toggle::make('activo'),
                Forms\Components\FileUpload::make('imagen_url')
                    ->disk('public')
                    ->directory('banner')
                    // ->visibility('private')
                    ->openable()
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('texto_principal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('texto_secundario')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('imagen_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('imagen_alt')
                    ->searchable(),
                Tables\Columns\TextColumn::make('boton_texto')
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
