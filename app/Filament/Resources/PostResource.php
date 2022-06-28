<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class PostResource extends Resource {
    protected static  ? string $model = Post::class;

    protected static  ? string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form) : Form {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Textarea::make('content')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table) : Table {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->toggleable(isToggledHiddenByDefault : true)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('content')
                    ->limit(30)
                    ->tooltip(fn($record): string => $record->content)
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault : true)
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault : true)
                    ->dateTime(),
            ])
            ->defaultSort('title', 'desc')
            ->filters([
                //
            ]);
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
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view'   => Pages\ViewPost::route('/{record}'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
