<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;


class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Blog Details')
                    ->columns(1)
                    ->schema([
                        Hidden::make('created_by')
                            ->default(fn() => auth()->id())
                            ->required(),

                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->columnSpanFull()
                            ->afterStateUpdated(
                                fn($state, $set) =>
                                $set('slug', Str::slug($state))
                            ),

                        TextInput::make('slug')
                            ->required()
                            ->columnSpanFull()
                            ->unique(ignoreRecord: true),

                        Select::make('categories')
                            ->relationship('categories', 'title')
                            ->multiple()
                            ->preload()
                            ->columnSpanFull()
                            ->required(),

                        FileUpload::make('thumbnail')
                            ->image()
                            ->directory('blogs')
                            ->columnSpanFull()
                            ->required(),

                        FileUpload::make('featured_image')
                            ->image()
                            ->directory('blogs')
                            ->columnSpanFull()
                            ->required(),

                        RichEditor::make('excerpt')
                            ->required()
                            ->fileAttachmentsDirectory('blog_attachments')
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->required()
                            ->fileAttachmentsDirectory('blog_attachments')
                            ->columnSpanFull(),

                        TextInput::make('meta_title')->required()->columnSpanFull(),
                        Textarea::make('meta_description')->required()->columnSpanFull(),

                        TextInput::make('reading_time')
                            ->numeric()
                            ->columnSpanFull()
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->columnSpanFull()
                            ->required(),

                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->required()->columnSpanFull(),

                        Toggle::make('is_featured')->required(),
                        TextInput::make('video_url'),
                        TextInput::make('location'),
                    ])->columns()->columnSpanFull(),

            ]);
    }
}
