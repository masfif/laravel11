<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Facades\Filament;

class EditBarang extends EditRecord
{
    protected static string $resource = BarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**  */

    protected function canEdit(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();

        return $user?->hasAnyRole(['super-admin', 'admin-masjid', 'finance']);
    }


    protected function canDelete(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();

        return $user?->hasAnyRole(['super-admin', 'admin-masjid', 'finance']);
    }
}
