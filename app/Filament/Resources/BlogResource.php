<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Blog;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BlogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogResource\RelationManagers;

class BlogResource extends Resource
{
    protected static ?int $navigationSort = 6;
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Blogs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')->label('Select Category')->required()->options(
                    Category::published()->pluck('name','id')->toArray(),
                )->searchable(['name']),
                TextInput::make('title')->label('Title')->placeholder('Enter Blog Title')->required()
                ->live()->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->label('Slug')->placeholder('Blg Slug')->required(),
                TextInput::make('short_description')->label('Short Description')->placeholder('Enter Short Description'),
                RichEditor::make('description')->label('Description')->placeholder('Enter Description')->columnSpanFull(),
                FileUpload::make('image')->label('Select Image')->required()->columnSpanFull(),
                TextInput::make('meta_title')->label('Meta title')->placeholder('Enter Meta Title'),
                TextInput::make('meta_description')->label('Meta Description')->placeholder('Enter Meta Description'),
                TextInput::make('meta_tags')->label('Meta Tags')->placeholder('Enter Meta Tags'),
                Select::make('status')->options([
                    '0'=> 'In active',
                    '1'=> 'Active',
                ])->required()->label('Blog Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name','Category')->label('Category Name')->searchable(),
                ImageColumn::make('image')->circular(),
                TextColumn::make('title')->limit(20)->markdown()->label('Title')->searchable(),
                TextColumn::make('slug')->limit(20)->markdown()->label('Slug')->searchable(),
                ToggleColumn::make('status')->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation()
                ->action(fn (Blog $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation()
                    ->action(fn (Blog $record) => $record->delete()),
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
            'index' => Pages\ListBlogs::route('/'),
           // 'create' => Pages\CreateBlog::route('/create'),
           // 'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
