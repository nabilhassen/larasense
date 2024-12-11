<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublisherResource\Pages\ManagePublishers;
use App\Models\Publisher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PublisherResource extends Resource
{
    protected static ?string $model = Publisher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                FileUpload::make('logo')
                    ->directory('publishers')
                    ->required(),

                Toggle::make('is_displayed')
                    ->required(),

                Toggle::make('is_tracked')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->circular(),

                TextColumn::make('name')
                    ->searchable(),

                ToggleColumn::make('is_displayed')
                    ->label('Allow Content'),

                ToggleColumn::make('is_tracked')
                    ->label('Track Content'),

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
                EditAction::make()->button()->outlined(),

                DeleteAction::make()->button(),

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
            'index' => ManagePublishers::route('/'),

        ];
    }
}
