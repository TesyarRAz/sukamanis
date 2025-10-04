<?php

namespace App\Filament\Imports;

use App\Models\Penduduk;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PendudukImporter extends Importer
{
    protected static ?string $model = Penduduk::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nkk')
                ->requiredMapping()
                ->rules(['required', 'max:16']),
            ImportColumn::make('nik')
                ->requiredMapping()
                ->rules(['required', 'max:16']),
            ImportColumn::make('nama')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('tempat_lahir')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('tanggal_lahir')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('alamat')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('jenis_kelamin')
                ->requiredMapping()
                ->rules(['required', 'max:15']),
            ImportColumn::make('rt')
                ->requiredMapping()
                ->rules(['required', 'max:3']),
            ImportColumn::make('rw')
                ->requiredMapping()
                ->rules(['required', 'max:3']),
            ImportColumn::make('pekerjaan')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Penduduk
    {
        return Penduduk::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'nik' => $this->data['nik'],
        ]);

        return new Penduduk();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your penduduk import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
