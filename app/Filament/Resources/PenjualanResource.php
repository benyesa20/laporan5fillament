<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Filament\Resources\PenjualanResource\RelationManagers;
use App\Models\Penjualan;
use App\Models\Barang; // Import model Barang
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barang_id')
                    ->relationship('barang', 'nama_barang') // Menghubungkan ke model Barang
                    ->required()
                    ->label('Nama Barang'),

                Forms\Components\TextInput::make('jumlah_penjualan')
                    ->required()
                    ->numeric()
                    ->label('Jumlah Penjualan'),

                Forms\Components\TextInput::make('total_harga')
                    ->required()
                    ->numeric()
                    ->label('Total Harga'),

                Forms\Components\Select::make('jenis_pembayaran')
                    ->options([
                        'tunai' => 'Tunai',
                        'kredit' => 'Kredit',
                        'debit' => 'Debit',
                    ])
                    ->required()
                    ->label('Jenis Pembayaran'),

                Forms\Components\DatePicker::make('tanggal_penjualan')
                    ->required()
                    ->label('Tanggal Penjualan'),

                Forms\Components\FileUpload::make('bukti_transaksi')
                    ->label('Bukti Transaksi')
                    ->required()
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barang.nama_barang')->label('Nama Barang'), // Menampilkan nama barang
                Tables\Columns\TextColumn::make('jumlah_penjualan')->label('Jumlah Penjualan'),
                Tables\Columns\TextColumn::make('total_harga')->label('Total Harga'),
                Tables\Columns\TextColumn::make('jenis_pembayaran')->label('Jenis Pembayaran'),
                Tables\Columns\TextColumn::make('tanggal_penjualan')->label('Tanggal Penjualan'),
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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
