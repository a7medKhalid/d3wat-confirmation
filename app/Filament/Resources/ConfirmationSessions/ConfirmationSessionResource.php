<?php

namespace App\Filament\Resources\ConfirmationSessions;

use App\Filament\Resources\ConfirmationSessions\Pages\CreateConfirmationSession;
use App\Filament\Resources\ConfirmationSessions\Pages\EditConfirmationSession;
use App\Filament\Resources\ConfirmationSessions\Pages\ListConfirmationSessions;
use App\Filament\Resources\ConfirmationSessions\Schemas\ConfirmationSessionForm;
use App\Filament\Resources\ConfirmationSessions\Tables\ConfirmationSessionsTable;
use App\Models\ConfirmationSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConfirmationSessionResource extends Resource
{
    protected static ?string $model = ConfirmationSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'الفعاليات';

    protected static ?string $modelLabel = 'فعالية';

    protected static ?string $pluralModelLabel = 'الفعاليات';

    public static function form(Schema $schema): Schema
    {
        return ConfirmationSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConfirmationSessionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListConfirmationSessions::route('/'),
            'create' => CreateConfirmationSession::route('/create'),
            'edit' => EditConfirmationSession::route('/{record}/edit'),
        ];
    }
}
