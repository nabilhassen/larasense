<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\SourceType;
use App\Filament\Resources\SourceResource\Pages\ManageSources;
use App\Models\Source;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SourceResource extends Resource
{
    protected static ?string $model = Source::class;

    protected static ?string $navigationIcon = 'heroicon-o-rss';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('publisher_id')
                    ->required()
                    ->relationship('publisher', 'name'),

                TextInput::make('url')
                    ->label('RSS URL')
                    ->required()
                    ->url(),

                Select::make('type')
                    ->required()
                    ->enum(SourceType::class)
                    ->options(SourceType::class),

                TextInput::make('default_author')
                    ->required(),

                Toggle::make('is_tracked')
                    ->label('Track Source')
                    ->required()
                    ->default(true),

                Toggle::make('is_displayed')
                    ->label('Allow Source')
                    ->required()
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('#')
                    ->rowIndex(),

                TextColumn::make('publisher.name')
                    ->searchable(['publishers.name', 'url'])
                    ->sortable()
                    ->description(fn (Source $record): string => str($record->url)->limit(50)->toString()),

                ToggleColumn::make('is_tracked')
                    ->alignCenter()
                    ->label('Track Source'),

                ToggleColumn::make('is_displayed')
                    ->alignCenter()
                    ->label('Allow Source'),

                TextColumn::make('last_checked_at')
                    ->label('Last Check')
                    ->placeholder('N/A')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('type')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('default_author')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                ]),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSources::route('/'),

        ];
    }
}
