@extends('layouts.app')

@section('title', 'Pengajuan Surat')

@section('content')
<div class="container bg-white mt-4 pt-3 pb-1 px-4 shadow-sm rounded">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-fill"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengajuan Surat</li>
        </ol>
    </nav>
</div>
<div class="container bg-white shadow-sm border-0 rounded mt-3 mb-5 p-4">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Surat</th>
                <th>Status Surat</th>
                <th>Tanggal Verifikasi</th>
                <th width="105px">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                <td>{{ $item->nomor }}</td>
                <td>{{ $item->surat->name }}</td>
                <td>
                    @switch ($item->status)
                    @case(\App\StatusPengajuanSurat::Requested)
                    <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
                    @break
                    @case(\App\StatusPengajuanSurat::Accepted)
                    <span class="badge bg-success">Disetujui</span>
                    @break
                    @case(\App\StatusPengajuanSurat::Rejected)
                    <span class="badge bg-danger">Ditolak</span>
                    @break
                    @endswitch
                </td>
                <td>{{ $item->verified_at?->format('d-m-Y H:i:s') }}</td>
                <td>
                    {{-- @if ($item->hasMedia('cached_berkas'))
                    <a href="{{ $item->getFirstMediaUrl('cached_berkas') }}" class="btn btn-sm btn-outline-primary">Download</a>
                    @endif --}}

                    @if ($item->signSurats->isNotEmpty())
                    @php
                    $latestSignSurat = $item->signSurats->first();
                    @endphp
                    <a href="{{ route('document.signed', $latestSignSurat->signature_code) }}" class="btn btn-sm btn-outline-primary" target="_blank">Lihat Surat</a>
                    @else
                    <span class="text-muted">Belum ada surat</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada data</td>
            </tr>
            @endforelse

            {{ $data->links() }}
        </tbody>
    </table>
</div>
@endsection