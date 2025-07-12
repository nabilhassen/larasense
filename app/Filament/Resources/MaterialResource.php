<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\SourceType;
use App\Filament\Resources\MaterialResource\Pages\ManageMaterials;
use App\Models\Material;
use App\Models\Source;
use Carbon\CarbonInterval;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('source_id')
                    ->required()
                    ->relationship('source', 'url')
                    ->live()
                    ->afterStateUpdated(function (Set $set): void {
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
                    ->unique(ignoreRecord: true),

                TextInput::make('duration')
                    ->integer()
                    ->hint('In Seconds')
                    ->hidden(function (Get $get): bool {
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
            'index' => ManageMaterials::route('/'),

        ];
    }
}
