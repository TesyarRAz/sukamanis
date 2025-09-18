<?php

namespace App\Filament\Resources\PengajuanSuratResource\Pages;

use App\Filament\Resources\PengajuanSuratResource;
use App\Jobs\GeneratePengajuanSurat;
use App\Models\PengajuanSurat;
use App\StatusPengajuanSurat;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPengajuanSurat extends ViewRecord
{
    protected static string $resource = PengajuanSuratResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('nomor'),
                TextEntry::make('surat.name'),
                TextEntry::make('user.name'),
                TextEntry::make('status')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        StatusPengajuanSurat::Requested => 'warning',
                        StatusPengajuanSurat::Accepted => 'success',
                        StatusPengajuanSurat::Rejected => 'danger',
                        default => 'gray',
                    }),
                KeyValueEntry::make('data'),
                TextEntry::make('berkas')
                    ->getStateUsing(fn(PengajuanSurat $record) => $record->getFirstMedia('cached_berkas')?:'No cached file')
                    ->formatStateUsing(fn($state) => gettype($state) == 'string' ? 'Belum di generate': 'Last generate: ' . $state->updated_at->diffForHumans())
                    ->suffixActions([
                        Action::make('downloadDocument')
                            ->icon('heroicon-o-document-text')
                            ->visible(fn(PengajuanSurat $record) => $record->getFirstMedia('cached_berkas'))
                            ->url(fn(PengajuanSurat $record) => $record->getFirstMediaUrl('cached_berkas'))
                            ->openUrlInNewTab(),
                        Action::make('generateDocument')
                            ->icon('heroicon-o-plus-circle')
                            ->requiresConfirmation()
                            ->action(function (PengajuanSurat $record) {
                                GeneratePengajuanSurat::dispatchSync($record->id);
                            }),
                        Action::make('signDocument')
                            ->icon('heroicon-o-pencil-square')
                            ->visible(fn(PengajuanSurat $record) => $record->getFirstMedia('cached_berkas'))
                            ->url(fn(PengajuanSurat $record) => route('sign.document', ['pengajuan_surat_id' => $record->id]))
                            ->openUrlInNewTab(),
                    ]),
                TextEntry::make('verified_at')
                    ->dateTime(),
                TextEntry::make('tanggal_pengajuan')
                    ->date(),
                
            ]);
    }
}
