<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class SiteSettings extends Page
{
    protected string $view = 'filament.pages.site-settings';

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Site Settings';

    protected static string|UnitEnum|null $navigationGroup =
        'Content Management';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::first();

        $this->form->fill(
            $settings?->toArray() ?? []
        );
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([

                Section::make('Contact Information')
                    ->schema([

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->columnSpanFull(),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp Number')
                            ->tel()
                            ->helperText('Include country code, for example +971...')
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->email()
                            ->columnSpanFull(),

                        Textarea::make('address')
                            ->rows(3)
                            ->columnSpanFull(),

                    ]),

                Section::make('Social Media')
                    ->schema([

                        TextInput::make('facebook')
                            ->url()
                            ->columnSpanFull(),

                        TextInput::make('instagram')
                            ->url()
                            ->columnSpanFull(),

                        TextInput::make('linkedin')
                            ->url()
                            ->columnSpanFull(),

                        TextInput::make('youtube')
                            ->url()
                            ->columnSpanFull(),

                        TextInput::make('x')
                            ->label('X / Twitter')
                            ->url()
                            ->columnSpanFull(),

                    ]),

            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            $data
        );

        Notification::make()
            ->title('Site settings updated')
            ->success()
            ->send();
    }

    
}