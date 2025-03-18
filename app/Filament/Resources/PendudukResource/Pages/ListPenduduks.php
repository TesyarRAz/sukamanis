<?php

namespace App\Filament\Resources\PendudukResource\Pages;

use App\Filament\Resources\PendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PendudukImport; // Pastikan ini sesuai dengan nama class import
use Livewire\WithFileUploads;

class ListPenduduks extends ListRecords
{
    use WithFileUploads;

    protected static string $resource = PendudukResource::class;

    public $file; // Hapus duplikasi

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $title = "Import Data Penduduk"; // Definisikan variabel title
        return view('filament.pages.penduduk-import', compact('title'));
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new PendudukImport, $this->file->getRealPath());

        session()->flash('message', 'Data berhasil diimpor!');
    }
}
