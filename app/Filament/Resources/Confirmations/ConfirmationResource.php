<?php

namespace App\Filament\Resources\Confirmations;

use App\Filament\Resources\Confirmations\Pages\ListConfirmations;
use App\Filament\Resources\Confirmations\Tables\ConfirmationsTable;
use App\Models\Confirmation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConfirmationResource extends Resource
{
    protected static ?string $model = Confirmation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    protected static ?string $navigationLabel = 'التأكيدات';

    protected static ?string $modelLabel = 'تأكيد';

    protected static ?string $pluralModelLabel = 'التأكيدات';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return ConfirmationsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConfirmations::route('/'),
        ];
    }
}
