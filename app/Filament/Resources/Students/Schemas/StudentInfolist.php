<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('full_name'),
                TextEntry::make('birth_date')
                    ->date(),
                TextEntry::make('mobile_number'),
                TextEntry::make('grade'),
                TextEntry::make('location'),
                TextEntry::make('guardian_name'),
                TextEntry::make('guardian_id_number'),
                TextEntry::make('scholarship_amount')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
