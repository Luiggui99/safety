<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionItemResource\Pages;
use App\Filament\Resources\SectionItemResource\RelationManagers;
use App\Models\SectionItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionItemResource extends Resource
{
    protected static ?string $model = SectionItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('section_id')
                    ->relationship(name: 'section', titleAttribute: 'nombre')
                    ->native(false)
                    ->required(),
                Forms\Components\ColorPicker::make('section_background')
                    ->rgb()
                    ->regex('/^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/')
                    ->required(),
                Forms\Components\TextInput::make('titulo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitulo')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Textarea::make('contenido')
                    ->hint('Puede ingresar código HTML')
                    ->hintColor('info')
                    ->rows(8)
                    ->columnSpanFull()
                    ->maxLength(65535),
                Forms\Components\FileUpload::make('imagen')
                    ->columnSpanFull()
                    ->disk('public')
                    ->directory('section_item')
                    ->visibility('private')
                    ->openable()
                    ->image(),
                Forms\Components\TextInput::make('boton_nombre')
                    ->maxLength(255),
                Forms\Components\ColorPicker::make('boton_color')
                    ->rgb()
                    ->regex('/^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/'),
                Forms\Components\TextInput::make('boton_icon')
                    ->maxLength(255),
                Forms\Components\TextInput::make('boton_url')
                    ->maxLength(255),
                Forms\Components\ToggleButtons::make('activo')
                    ->boolean()
                    ->grouped()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section.nombre')
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('subtitulo')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('contenido')
                //     ->searchable(),
                Tables\Columns\ImageColumn::make('imagen'),
                Tables\Columns\TextColumn::make('boton_nombre')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('boton_color')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('boton_icon')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('boton_url')
                //     ->searchable(),
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
            'index' => Pages\ListSectionItems::route('/'),
            'create' => Pages\CreateSectionItem::route('/create'),
            'edit' => Pages\EditSectionItem::route('/{record}/edit'),
        ];
    }
}
