<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // We are just listing the fields directly now to avoid the error
                TextInput::make('full_name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('birth_date')
                    ->label('Date of Birth')
                    ->required()
                    ->native(true) // It is true so we can right the date
                    ->displayFormat('d/m/Y'),

                TextInput::make('mobile_number')
                    ->label('Mobile Number')
                    ->tel()
                    ->required(),

                TextInput::make('grade')
                    ->label('Grade / Level')
                    ->placeholder('e.g., 10th Grade')
                    ->required(),

                TextInput::make('location')
                    ->label('Address / Location')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('guardian_name')
                    ->label('Guardian Name')
                    ->required(),

                TextInput::make('guardian_id_number')
                    ->label('Guardian ID (DUI)')
                    ->required(),

                TextInput::make('scholarship_amount')
                    ->label('Scholarship Amount')
                    ->prefix('$')
                    ->numeric()
                    ->required(),
            ]);
    }
}