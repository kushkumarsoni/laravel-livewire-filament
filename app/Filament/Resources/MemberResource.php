<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Member;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MemberResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MemberResource\RelationManagers;

class MemberResource extends Resource
{
    protected static ?int $navigationSort = 2;
    protected static ?string $model = Member::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Teams';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('Member Name')->placeholder('Enter member name'),
                TextInput::make('designation')->required()->label('Designation')->placeholder('Enter designation'),
                TextInput::make('fb_url')->label('Facebook URL')->placeholder('Enter Facebook URL'),
                TextInput::make('in_url')->label('Instagram URL')->placeholder('Enter Instagram URL'),
                TextInput::make('tw_url')->label('Twitter URL')->placeholder('Enter Twitter URL'),
                Select::make('status')->options([
                    '0'=> 'In active',
                    '1'=> 'Active',
                ])->required()->label('Status'),
                FileUpload::make('image')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->circular()->size(50),
                TextColumn::make('name')->searchable(),
                TextColumn::make('designation')->searchable(),
                TextColumn::make('fb_url'),
                TextColumn::make('in_url'),
                TextColumn::make('tw_url'),
                ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation()
                ->action(fn (Member $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation()
                    ->action(fn (Member $record) => $record->delete()),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
