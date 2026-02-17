<?php

namespace App\Filament\Resources\Students\Tables;

// 🟢 Notice: We are using "Filament\Actions" here, which matches your version!
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('age')
                    ->label('Age')
                    ->suffix(' years'),

                TextColumn::make('grade')
                    ->label('Grade')
                    ->searchable(),

                TextColumn::make('location')
                    ->label('Location')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('guardian_name')
                    ->label('Guardian')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('scholarship_amount')
                    ->label('Amount')
                    ->money('USD')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}