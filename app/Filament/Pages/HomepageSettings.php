<?php

namespace App\Filament\Pages;

use App\Models\HomeSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class HomepageSettings extends Page
{
    protected string $view = 'filament.pages.homepage-settings';

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedHome;

    protected static ?string $navigationLabel = 'Homepage Settings';

    protected static string|UnitEnum|null $navigationGroup =
        'Content Management';

    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = HomeSetting::first();

        $this->form->fill(
            $settings?->toArray() ?? []
        );
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([

                Section::make('Hero Media')
                    ->schema([

                        FileUpload::make('hero_video')
                            ->label('Hero Video')
                            ->disk('s3')
                            ->directory('homepage/hero/videos')
                            ->visibility('private')
                            ->acceptedFileTypes([
                                'video/mp4',
                                'video/webm',
                            ])
                            ->maxSize(51200)
                            ->helperText(
                                'Upload an optimized MP4 or WebM video. Recommended maximum size: 50 MB.'
                            )
                            ->columnSpanFull(),

                        FileUpload::make('hero_poster')
                            ->label('Hero Poster Image')
                            ->disk('s3')
                            ->directory('homepage/hero/posters')
                            ->visibility('private')
                            ->image()
                            ->imageEditor()
                            ->maxSize(4096)
                            ->helperText(
                                'Displayed while the video is loading and on devices where video playback is unavailable.'
                            )
                            ->columnSpanFull(),

                    ]),

            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // dd($data);

        HomeSetting::query()->updateOrCreate(
            ['id' => 1],
            $data
        );
    }
}
