<?php

namespace App\Filament\Resources\RedesSocialeResource\Pages;

use App\Filament\Resources\RedesSocialeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRedesSociales extends ListRecords
{
    protected static string $resource = RedesSocialeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
