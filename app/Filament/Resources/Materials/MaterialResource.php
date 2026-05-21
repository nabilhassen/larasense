<?php

declare(strict_types=1);

namespace App\Filament\Resources\Materials;

use App\Enums\SourceType;
use App\Filament\Resources\Materials\Pages\ManageMaterials;
use App\Models\Material;
use App\Models\Source;
use BackedEnum;
use Carbon\CarbonInterval;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('source_id')
                    ->required()
                    ->relationship('source', 'url')
                    ->live()
                    ->afterStateUpdated(function (\Filament\Schemas\Components\Utilities\Set $set): void {
                        $set('duration', null);
                    }),

                TextInput::make('title')
                    ->required(),

                RichEditor::make('description'),

                RichEditor::make('body'),

                TextInput::make('author'),

                Toggle::make('is_displayed')
                    ->label('Allow Material')
                    ->required(),

                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->unique(),

                TextInput::make('duration')
                    ->integer()
                    ->hint('In Seconds')
                    ->hidden(function (\Filament\Schemas\Components\Utilities\Get $get): bool {
                        return Source::find($get('source_id'))?->type !== SourceType::Podcast;
                    }),

                TextInput::make('image_url'),

                DateTimePicker::make('published_at')
                    ->required(),

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

                ImageColumn::make('image_url')
                    ->square()
                    ->placeholder('N/A'),

                TextColumn::make('source.publisher.name')
                    ->searchable()
                    ->description(fn (Material $record): string => str($record->url)->limit(50)->toString())
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('title')
                    ->searchable()
                    ->words(5)
                    ->html()
                    ->tooltip(fn (Material $record): string => $record->title),

                ToggleColumn::make('is_displayed')
                    ->alignCenter()
                    ->label('Allow Material'),

                TextColumn::make('duration')
                    ->numeric()
                    ->sortable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->state(function (Material $record): ?string {
                        return filled($record->duration)
                        ? CarbonInterval::seconds($record->duration)->cascade()->forHumans(['short' => true])
                        : null;
                    }),

                TextColumn::make('author')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('views')
                    ->alignCenter()
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('expands')
                    ->alignCenter()
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('redirects')
                    ->alignCenter()
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('plays')
                    ->alignCenter()
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
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
            'index' => ManageMaterials::route('/'),

        ];
    }
}
