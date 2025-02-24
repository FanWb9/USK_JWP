<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Filament\Resources\PeminjamanResource\RelationManagers;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralModelLabel(): string
    {
        return 'Peminjaman';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Select::make('anggota_id')
                    ->label('Nama Anggota')
                    ->options(User::pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->preload(),

                    Forms\Components\Select::make('barang_id')
                    ->label('Nama Barang')
                    ->options(Barang::pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                    
                    Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah')
                    ->default(1)
                    ->required(),
                   

                    Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Pinjam'=>'Pinjam',
                        'Selesai'=>'Selesai',
                    ])
                    ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('anggota_id')
                    ->label('Nama Anggota')
                    ->formatStateUsing(fn ($state) => User::find($state)?->name ?? '-'),
                Tables\Columns\TextColumn::make('barang_id')
                    ->label('Nama Barang')
                    ->formatStateUsing(fn ($state) => Barang::find($state)?->nama ?? '-'),
                Tables\Columns\TextColumn::make('quantity')->label('Jumlah'),
                Tables\Columns\BadgeColumn::make('status')->label('Status')->colors([
                    'Pinjam' => 'warning',
                    'Selesai' => 'success',
                ]),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPeminjamen::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
