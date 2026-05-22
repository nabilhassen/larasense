<?php

declare(strict_types=1);

namespace App\Filament\Resources\Publishers;

use App\Filament\Resources\Publishers\Pages\ManagePublishers;
use App\Models\Publisher;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class PublisherResource extends Resource
{
    protected static ?string $model = Publisher::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->unique()
                    ->required(),

                FileUpload::make('logo')
                    ->disk('public')
                    ->directory('publishers')
                    ->required(),

                Toggle::make('is_displayed')
                    ->label('Allow Publisher')
                    ->required()
                    ->default(true),

                Toggle::make('is_tracked')
                    ->label('Track Publisher')
                    ->required()
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultKeySort(false)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('#')
                    ->rowIndex(),

                ImageColumn::make('logo')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('name')
                    ->searchable(),

                ToggleColumn::make('is_displayed')
                    ->alignCenter()
                    ->label('Allow Publisher'),

                ToggleColumn::make('is_tracked')
                    ->alignCenter()
                    ->label('Track Publisher'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->recordActions([
                \Filament\Actions\ActionGroup::make([
                    \Filament\Actions\EditAction::make(),
                    \Filament\Actions\DeleteAction::make(),
                ]),

            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),

                ]),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePublishers::route('/'),

        ];
    }
}
