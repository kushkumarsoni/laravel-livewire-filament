<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\HomeSetting;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HomeSettingResource\Pages;
use App\Filament\Resources\HomeSettingResource\RelationManagers;

class HomeSettingResource extends Resource
{
    protected static ?int $navigationSort = 10;
    protected static ?string $model = HomeSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Title')->placeholder('Enter Title')->required(),
                TextInput::make('sub_title')->label('sub_title')->placeholder('Enter Sub Title')->required(),
                RichEditor::make('description')->label('description')->placeholder('Enter Description')->columnSpanFull(),
                TextInput::make('btn_text')->label('Btn Text')->placeholder('Enter Button Text'),
                TextInput::make('btn_link')->label('Btn Link')->placeholder('Enter Button Link'),
                FileUpload::make('image')->label('Image')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title'),
                TextColumn::make('sub_title'),
                TextColumn::make('btn_text'),
                TextColumn::make('btn_link'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation()
                ->action(fn (HomeSetting $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->action(fn (HomeSetting $record) => $record->delete()),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])->defaultSort('created_at','desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeSettings::route('/'),
            // 'create' => Pages\CreateHomeSetting::route('/create'),
            // 'edit' => Pages\EditHomeSetting::route('/{record}/edit'),
        ];
    }
}
