<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str; 


class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Category Details')
                    ->columns(1)
                    ->schema([

                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->live(debounce: 500)
                            ->columnSpanFull()
                            ->afterStateUpdated(function (callable $set, ?string $state) {
                                if (filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),


                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->unique(ignoreRecord: true),

                        RichEditor::make('description')
                            ->label('Description')
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->required()
                            ->directory('categories')
                            ->columnSpanFull()
                            ->imageEditor(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->columnSpanFull()
                            ->required(),

                        Hidden::make('created_by')
                            ->default(fn() => auth()->id())
                            ->dehydrated(),


                        TextInput::make('canonical_url')
                            ->label('Canonical_url')
                            ->url()
                            ->columnSpanFull()
                            ->required(),

                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(1000),

                        TextInput::make('meta_description')
                            ->label('Meta Description')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(1000),

                    ])->columns()->columnSpanFull(),
            ]);
    }
}
