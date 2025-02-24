<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralModelLabel(): string
    {
        return 'Barang';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('kode')
                    ->label('Kode Barang')
                    ->placeholder('Masukkan Kode Barang')
                    ->minLength(9)
                    ->numeric()
                    ->required(),
                    
                    Forms\Components\TextInput::make('nama')
                    ->label('Nama Barang')
                    ->placeholder('Masukkan Nama Barang')
                    ->required(),

                    Forms\Components\FileUpload::make('images')
                    ->label('Gambar Barang')
                    ->placeholder('Pilih Gambar Barang')
                    ->directory('public/images')
                    ->image()
                    ->maxSize(4 * 1024) // Set maximum file size to 4MB
                    ->required(),

                    Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah Barang')
                    ->placeholder('Masukkan Jumlah Barang')
                    ->default(1)
                    ->numeric()
                    ->required(),

                    Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Barang')
                    ->placeholder('Masukkan Deskripsi Barang')
                    ->required(),
                    
                    Forms\Components\TextInput::make('kategori')
                    ->label('Kategori Barang')
                    ->placeholder('Masukkan Kategori Barang')
                    ->required(),
                   
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('kode')->label('Kode Barang')->searchable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama Barang')->searchable(),
                Tables\Columns\ImageColumn::make('images')->label('Gambar Barang')->size(120)->circular()->disk('public'),
                Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi Barang'),
                Tables\Columns\TextColumn::make('kategori')->label('Kategori Barang'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
