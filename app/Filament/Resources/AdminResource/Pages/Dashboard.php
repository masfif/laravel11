<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\AktivitasAdmin;
use App\Filament\Widgets\AktivitasAdmin as WidgetsAktivitasAdmin;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $resource = WidgetsAktivitasAdmin::class;

    protected static string $view = 'filament.resources.admin-resource.pages.dashboard';

    public function getWidgets(): array
    {
        return [
            WidgetsAktivitasAdmin::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\AktivitasAdmin::class,
        ];
    }
}
