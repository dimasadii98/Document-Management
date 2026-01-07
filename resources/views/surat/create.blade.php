@extends('layouts.app')

@section('title', 'Tambah Surat')

@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Tambah Surat</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('surat.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Judul Surat</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Isi Surat</label>
                        <textarea name="isi" class="form-control" rows="4"></textarea>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
@endsection