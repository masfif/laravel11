<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori')
                    ->searchable()
                    ->required(),
                TextInput::make('stok')
                    ->required()
                    ->numeric(),
                TextInput::make('harga')
                    ->required()
                    ->numeric(),
                FileUpload::make('foto')
                    ->image()
                    ->directory('foto-barang')
                    ->preserveFilenames()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')->square(),
                TextColumn::make('nama_barang')
                    ->searchable(),
                TextColumn::make('kategori.nama_kategori'),
                TextColumn::make('harga')
                    ->money('IDR'),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori')
            ])
            ->headerActions([
                ExportAction::make(),
                ImportAction::make(),
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


    public static function canViewAny(): bool
    {
        /** @var \App\Models\User $user */
        $user = Filament::auth()->user();

        return $user?->hasAnyRole(['super-admin', 'admin-masjid']);
        return $user?->hasRole(['finance']);
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
