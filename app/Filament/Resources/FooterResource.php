<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterResource\Pages;
use App\Filament\Resources\FooterResource\RelationManagers;
use App\Models\Footer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ColorPicker::make('background')
                    ->rgb()
                    ->regex('/^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/')
                    ->required(),
                Forms\Components\TextInput::make('copyright')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Repeater::make('informacion')
                    ->schema([
                        Forms\Components\TextInput::make('nombre')->required(),
                        Forms\Components\TextInput::make('url')
                            ->url(),
                        Forms\Components\ToggleButtons::make('activo')
                            ->boolean()
                            ->grouped()
                            ->required(),
                    ])
                    ->deletable(false)
                    ->defaultItems(3)
                    ->columnSpanFull()
                    ->columns(3),
                Forms\Components\FileUpload::make('imagen')
                    ->disk('public')
                    ->directory('footer')
                    ->visibility('private')
                    ->openable()
                    ->image()
                    ->columnSpanFull()
                    ->required(),
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
                Tables\Columns\ColorColumn::make('background')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('imagen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('copyright')
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
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
