<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArsipResource\Pages;
use App\Filament\Resources\ArsipResource\RelationManagers;
use App\Models\Arsip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArsipResource extends Resource
{
    protected static ?string $model = Arsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi'),
                Forms\Components\Select::make('kategori')
                    ->options([
                        'Dokumen' => 'Dokumen',
                        'Foto' => 'Foto',
                        'Video' => 'Video',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_diterima'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Upload Arsip')
                    ->directory('arsip')
                    ->disk('public')
                    ->image()
                    ->imageEditor()

                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori'),
                Tables\Columns\TextColumn::make('tanggal_diterima')
                    ->date('Y-m-d') // Format tanggal
                    ->sortable(),

// php artisan storage:link
                    ImageColumn::make('file_path')
                        ->size(200),
                // Tables\Columns\TextColumn::make('file_path')
                //     ->label('File')
                //     ->url(fn($record) => Storage::url($record->file_path)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'Dokumen' => 'Dokumen',
                        'Foto' => 'Foto',
                        'Video' => 'Video',
                    ]),
                Tables\Filters\Filter::make('tanggal_diterima')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')->label('Tanggal Dari'),
                        Forms\Components\DatePicker::make('tanggal_sampai')->label('Tanggal Sampai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_dari'], fn($q) => $q->whereDate('tanggal_diterima', '>=', $data['tanggal_dari']))
                            ->when($data['tanggal_sampai'], fn($q) => $q->whereDate('tanggal_diterima', '<=', $data['tanggal_sampai']));
                    }),
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
            'index' => Pages\ListArsips::route('/'),
            'create' => Pages\CreateArsip::route('/create'),
            'edit' => Pages\EditArsip::route('/{record}/edit'),
        ];
    }
}
