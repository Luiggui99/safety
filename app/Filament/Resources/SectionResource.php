<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers;
use App\Models\Menu;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('section_titulo')
                    ->maxLength(255),
                Forms\Components\Select::make('section_id')
                    ->options(Menu::all()->pluck('url_enlace', 'id'))
                    ->native(false),
                Forms\Components\ColorPicker::make('background')
                    ->rgb()
                    ->regex('/^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/'),
                Forms\Components\TextInput::make('orden')
                    ->required()
                    ->numeric(),
                Forms\Components\FileUpload::make('imagen')
                    ->columnSpanFull()
                    ->disk('public')
                    ->directory('section')
                    ->visibility('private')
                    ->openable()
                    ->image(),
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
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('section_titulo')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('menu.url_enlace')
                    ->label('Enlace section'),
                Tables\Columns\TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
