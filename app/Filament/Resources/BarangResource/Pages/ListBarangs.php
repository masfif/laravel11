<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Facades\Filament;

class ListBarangs extends ListRecords
{
    protected static string $resource = BarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function canCreate(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();

        return $user?->hasAnyRole(['super-admin', 'admin-masjid']);
    }
}
