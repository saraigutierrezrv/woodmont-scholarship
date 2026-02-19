<?php

namespace App\Filament\Resources\Meetings\RelationManagers;

use App\Filament\Resources\Students\StudentResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema; 
use Filament\Forms\Components\Toggle;

// 🟢 In v5, many actions have moved here:
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';
    protected static ?string $relatedResource = StudentResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('attended')
                    ->label('Attended')
                    ->boolean(),

                Tables\Columns\IconColumn::make('grades_submitted')
                    ->label('Grades')
                    ->boolean(),

                Tables\Columns\IconColumn::make('letter_submitted')
                    ->label('Letter')
                    ->boolean(),
            ])
            ->actions([
                // 🟢 Using the new v5 Action location
                Action::make('update_status')
                    ->label('Update Status')
                    ->icon('heroicon-m-pencil-square')
                    ->modalHeading('Update Student Meeting Requirements')
                    ->form([
                        Toggle::make('attended')
                            ->label('Attendance Status'),
                        Toggle::make('grades_submitted')
                            ->label('Grades Received'),
                        Toggle::make('letter_submitted')
                            ->label('Letter Received'),
                    ])
                    ->mountUsing(fn (Schema $schema, $record) => $schema->fill([
                        'attended' => $record->attended,
                        'grades_submitted' => $record->grades_submitted,
                        'letter_submitted' => $record->letter_submitted,
                    ]))
                    ->action(function ($record, array $data): void {
                        // 🟢 THIS IS THE FIX:
                        // We reach into the relationship and update the bridge (pivot)
                        $this->getOwnerRecord()->students()->updateExistingPivot($record->id, [
                            'attended' => $data['attended'],
                            'grades_submitted' => $data['grades_submitted'],
                            'letter_submitted' => $data['letter_submitted'],
                        ]);
                    }),

                DetachAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('mark_attended')
                        ->label('Mark as Attended')
                        ->icon('heroicon-m-check-circle')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records): void {
                            $records->each(function ($record) {
                                $this->getOwnerRecord()->students()->updateExistingPivot($record->id, [
                                    'attended' => true,
                                ]);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    DetachBulkAction::make(),
                ]),
            ]);
            
    }
}