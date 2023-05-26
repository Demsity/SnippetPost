<?php

namespace App\Filament\Resources;

use App\Models\Post;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\CheckboxColumn;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\Builder;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    
    protected static ?string $navigationGroup = 'My Account';

    protected static ?string $navigationLabel = 'My Posts';

    // hasRole is working, its only an error in Intelephense plugin
    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin'))
            return parent::getEloquentQuery();
        return parent::getEloquentQuery()->where('user_id', auth()->id());

    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('title')->label('Post Title'),
                    TextArea::make('text')->label('Post Content'),
                    Checkbox::make('is_visable')->label('Make Post Visable')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title'),
                ToggleColumn::make('is_visable')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }    
}
