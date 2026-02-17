<?php

namespace App\Filament\Resources\Meetings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MeetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                DatePicker::make('meeting_date')
                    ->label('Meeting Date')
                    ->required(),
                Select::make('status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'completed' => 'Completed',
                    ])
                    ->default('upcoming')
                    ->required(),
                Textarea::make('notes')
                    ->label('Meeting Notes')
                    ->columnSpanFull(),
            ]);
    }
}
