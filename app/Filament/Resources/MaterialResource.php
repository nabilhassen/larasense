<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages\ManageMaterials;
use App\Models\Material;
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
                    ->relationship('source', 'url'),

                TextInput::make('title')
                    ->required(),

                TextInput::make('description')
                    ->required(),

                TextInput::make('body'),

                TextInput::make('author'),

                Toggle::make('is_displayed')
                    ->label('Allow Material')
                    ->required(),

                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required(),

                TextInput::make('image_url')
                    ->url()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url'),

                TextColumn::make('source.publisher.name')
                    ->searchable(),

                TextColumn::make('title')
                    ->searchable()
                    ->description(fn(Material $record): string => $record->description),

                ToggleColumn::make('is_displayed')
                    ->alignCenter()
                    ->label('Allow Material'),

                TextColumn::make('author')
                    ->searchable()
                    ->placeholder('N/A')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('url')
                    ->label('URL')
                    ->searchable(),

                TextColumn::make('views')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),

                TextColumn::make('clicks')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),

                TextColumn::make('redirects')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),

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
