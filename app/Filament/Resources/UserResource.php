<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\ManageUsers;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->required(fn (string $operation) => $operation === 'create')
                    ->maxLength(255)
                    ->revealable()
                    ->dehydrateStateUsing(static function (?string $state, ?User $record) {
                        return filled($state)
                        ? Hash::make($state)
                        : $record->password;
                    }),

                DateTimePicker::make('email_verified_at'),

                Select::make('provider')
                    ->options(['google', 'github'])
                    ->requiredWith('provider_id'),

                TextInput::make('provider_id')
                    ->requiredWith('provider'),

                FileUpload::make('avatar_url')
                    ->label('Avatar')
                    ->avatar()
                    ->alignCenter(),

                Select::make('timezone')
                    ->options(array_combine(timezone_identifiers_list(), timezone_identifiers_list()))
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

                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular(),

                TextColumn::make('name')
                    ->searchable(['name', 'email'])
                    ->icon(fn (User $record): ?string => $record->hasVerifiedEmail() ? 'heroicon-o-check-circle' : null)
                    ->iconPosition(IconPosition::After)
                    ->iconColor('primary')
                    ->description(fn (User $record): string => $record->email),

                TextColumn::make('provider')
                    ->searchable()
                    ->placeholder('No Provider')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('last_logged_in_at')
                    ->label('Last Login')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                TextColumn::make('provider_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                TextColumn::make('timezone')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

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

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUsers::route('/'),

        ];
    }
}
