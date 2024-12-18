<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KehadiranResource\Pages;
use App\Filament\Resources\KehadiranResource\RelationManagers;
use App\Models\Kehadiran;
use Dompdf\Dompdf;
use Dompdf\Options;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KehadiranResource extends Resource
{
    protected static ?string $model = Kehadiran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name') // Relasi ke User
                    ->required(),

                Select::make('qrcode_id')
                    ->label('QR Code')
                    ->relationship('qrCode', 'valid_date') // Relasi ke QrCode
                    ->required(),

                Select::make('status')
                    ->label('Status Kehadiran')
                    ->options([
                        'hadir' => 'Hadir',
                        'tidak' => 'Tidak hadir',
                    ])
                    ->required(),
            ]);
    }

    
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama User')
                    ->sortable()
                    ->searchable(),
    
                TextColumn::make('qrCode.code')
                    ->label('QR Code')
                    ->sortable()
                    ->searchable(),
    
                TextColumn::make('qrCode.valid_date')
                    ->label('Tanggal Kehadiran')
                    ->sortable()
                    ->date(),
    
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('valid_date_range')
                    ->label('Filter Rentang Tanggal Kehadiran')
                    ->form([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai'),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Akhir'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        // Store the filters in the session for later use
                        session([
                            'filter_start_date' => $data['start_date'] ?? null,
                            'filter_end_date' => $data['end_date'] ?? null,
                        ]);
    
                        // Apply the filters to the query
                        return $query->whereHas('qrCode', function (Builder $subQuery) use ($data) {
                            if (!empty($data['start_date'])) {
                                $subQuery->whereDate('valid_date', '>=', $data['start_date']);
                            }
                            if (!empty($data['end_date'])) {
                                $subQuery->whereDate('valid_date', '<=', $data['end_date']);
                            }
                        });
                    }),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Export PDF')
                    ->label('Export PDF')
                    ->action(function () {
                        // Retrieve the stored filter values from the session
                        $startDate = session('filter_start_date');
                        $endDate = session('filter_end_date');
    
                        // Build the filtered query
                        $filteredQuery = Kehadiran::query()->with(['user', 'qrCode']);
    
                        if ($startDate) {
                            $filteredQuery->whereHas('qrCode', function (Builder $subQuery) use ($startDate) {
                                $subQuery->whereDate('valid_date', '>=', $startDate);
                            });
                        }
    
                        if ($endDate) {
                            $filteredQuery->whereHas('qrCode', function (Builder $subQuery) use ($endDate) {
                                $subQuery->whereDate('valid_date', '<=', $endDate);
                            });
                        }
    
                        // Fetch the records
                        $records = $filteredQuery->get();
    
                        // Render data to HTML
                        $html = view('default-table', ['records' => $records])->render();
    
                        // Set up Dompdf
                        $options = new Options();
                        $options->set('isHtml5ParserEnabled', true);
                        $options->set('isRemoteEnabled', true);
    
                        $dompdf = new Dompdf($options);
                        $dompdf->loadHtml($html); // Render the HTML to PDF
                        $dompdf->setPaper('A4', 'landscape');
                        $dompdf->render();
    
                        return response()->streamDownload(
                            fn () => print($dompdf->output()),
                            'filtered_kehadiran.pdf'
                        );
                    })
                    ->color('primary'),
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
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKehadirans::route('/'),
            'create' => Pages\CreateKehadiran::route('/create'),
            'edit' => Pages\EditKehadiran::route('/{record}/edit'),
        ];
    }
}
