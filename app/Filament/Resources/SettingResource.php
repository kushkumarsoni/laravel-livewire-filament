<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SiteSetting;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SettingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SettingResource\RelationManagers;

class SettingResource extends Resource
{
    protected static ?int $navigationSort = 9;
    protected static ?string $model = SiteSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Site Title')->placeholder('Enter Site Title')->required(),
                TextInput::make('email')->label('Site Email')->placeholder('Enter Site Email')->required(),
                TextInput::make('mobile')->label('Site Mobile')->placeholder('Enter Site Mobile')->required(),
                TextInput::make('pincode')->label('Site Pincode')->placeholder('Enter Site Pincode')->required(),
                TextInput::make('address')->label('Site Address')->placeholder('Enter Site Address')->required(),
                FileUpload::make('logo')->label('Site Logo'),
                TextInput::make('facebook')->label('Facebook URL')->placeholder('Enter Facebook URL'),
                TextInput::make('instagram')->label('Instagram URL')->placeholder('Enter Instagram URL'),
                TextInput::make('twitter')->label('Twitter URL')->placeholder('Enter Twitter URL'),
                TextInput::make('meta_title')->label('Meta Title')->placeholder('Enter Meta Title'),
                TextInput::make('meta_description')->label('Meta Description')->placeholder('Enter Meta Description'),
                TextInput::make('meta_keywords')->label('Meta Keywords')->placeholder('Enter Meta Keywords'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo'),
                TextColumn::make('title'),
                TextColumn::make('email'),
                TextColumn::make('mobile'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->action(fn (SiteSetting $record) => $record->delete())
                ->requiresConfirmation()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->action(fn (SiteSetting $record) => $record->delete())
                    ->requiresConfirmation(),
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
            'index' => Pages\ListSettings::route('/'),
            // 'create' => Pages\CreateSetting::route('/create'),
            // 'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
