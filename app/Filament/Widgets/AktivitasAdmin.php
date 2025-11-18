<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Barang;

class AktivitasAdmin extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total User', User::count())
                ->description('Semua user terdaftar')
                ->color('info'),

            Stat::make('Total Barang', Barang::count())
                ->description('Jumlah barang di database')
                ->color('success'),

            Stat::make('Admin Online', User::where('is_online', true)->count())
                ->description('Admin aktif sekarang')
                ->color('warning'),
        ];
    }
}
