<?php

namespace App\Filament\Resources\RedesSocialeResource\Pages;

use App\Filament\Resources\RedesSocialeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRedesSociale extends EditRecord
{
    protected static string $resource = RedesSocialeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
