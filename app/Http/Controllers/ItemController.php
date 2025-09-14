<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Item;

class ItemController extends Controller
{
    public function deleteItem($id)
    {
        // Menambahkan data ke session untuk konfirmasi penghapusan
        session()->flash('alert.delete', json_encode([
            'title' => 'Apakah Anda yakin?',
            'text' => 'Anda tidak dapat mengembalikannya!',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Ya, hapus!',
        ]));

        // Proses penghapusan item
        // $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index');
    }
}
