<?php

namespace App\Filament\Resources\Meetings\RelationManagers;

use App\Filament\Resources\Students\StudentResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $relatedResource = StudentResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                TextColumn::make('full_name')
                    ->label('Student Name'),

                // 🟢 The 3 Checkboxes (Toggles)
                ToggleColumn::make('attended')
                    ->label('Attended'),

                ToggleColumn::make('grades_submitted')
                    ->label('Grades'),

                ToggleColumn::make('letter_submitted')
                    ->label('Letter'),
            ])
            ->headerActions([
                // no more attach action
            ])
            ->actions([
                DetachAction::make(), //we keep the detach just in case we want to detach someone from the list
            ]);
    }
}