<?php

namespace App\Filament\Resources\BarangResource\Pages;

use App\Filament\Resources\BarangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;

    protected function canCreate(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();

        return $user?->hasAnyRole(['super-admin', 'admin-masjid']);
    }
}
