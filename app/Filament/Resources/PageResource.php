<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PageResource\RelationManagers;

class PageResource extends Resource
{
    protected static ?int $navigationSort = 8;
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Page Title')->placeholder('Enter page title')->required()
                ->live()->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->label('Slug')->placeholder('Page Slug')->required(),
                TextInput::make('short_description')->label('Short Description')->placeholder('Enter Short Description'),
                TextInput::make('meta_title')->label('Meta Title')->placeholder('Enter meta title'),
                TextInput::make('meta_tags')->label('Meta Tags')->placeholder('Enter meta tags setperate by comma'),
                TextInput::make('meta_description')->label('Meta Description')->placeholder('Enter Meta Description'),
                RichEditor::make('description')->label('Description')->placeholder('Enter Description')->columnSpanFull(),
                Select::make('status')->options([
                    '0'=> 'In active',
                    '1'=> 'Active',
                ])->required()->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('slug'),
                ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation()
                ->action(fn (Page $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation()
                    ->action(fn (Page $record) => $record->delete()),
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
            'index' => Pages\ListPages::route('/'),
            // 'create' => Pages\CreatePage::route('/create'),
            // 'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
