@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Upload Data Penduduk (CSV)</h4>
    <form action="{{ route('penduduk.uploadCsv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="csv" class="form-label">Pilih File CSV</label>
            <input type="file" name="csv" class="form-control" accept=".csv" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
