<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {   
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->label('Nama Barang'),
                
                Forms\Components\TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->label('Stok'),
                
                Forms\Components\TextInput::make('kategori')
                    ->required()
                    ->label('Kategori'),

                Forms\Components\Select::make('kondisi')
                    ->options([
                        'baru' => 'Baru',
                        'bekas' => 'Bekas',
                        'rusak' => 'Rusak',
                    ])
                    ->required()
                    ->label('Kondisi'),

                Forms\Components\FileUpload::make('gambar')
                    ->label('Gambar')
                    ->required()
                    ->image()
                    ->preserveFilenames(),

                Forms\Components\DatePicker::make('tanggal_masuk')
                    ->required()
                    ->label('Tanggal Masuk'),

                Forms\Components\Toggle::make('tersedia')
                    ->label('Tersedia')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang')->label('Nama Barang'),
                Tables\Columns\TextColumn::make('stok')->label('Stok'),
                Tables\Columns\TextColumn::make('kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('kondisi')->label('Kondisi'),
                Tables\Columns\TextColumn::make('tanggal_masuk')->label('Tanggal Masuk'),
                Tables\Columns\BooleanColumn::make('tersedia')->label('Tersedia'),
            ])
            ->filters([
                // Define your filters here if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            // Define relation managers here if needed
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
