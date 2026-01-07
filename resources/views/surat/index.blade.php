@extends('layouts.app')

@section('title', 'Data Surat')

@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Surat</h1>

            <a href="{{ route('surat.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Surat
            </a>
        </div>

        <!-- Card -->
        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>

                                @if(auth()->user()->role === 'admin')
                                    <th>Pembuat</th>
                                @endif

                                <th>Tanggal</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($surats as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->judul }}</td>
                                    <td>{{ $surat->kategori->nama_kategori ?? '-' }}</td>

                                    @if(auth()->user()->role === 'admin')
                                        <td>{{ $surat->user->name }}</td>
                                    @endif

                                    <td>{{ $surat->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('surat.show', $surat->id) }}"
                                        class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('surat.edit', $surat->id) }}"
                                        class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('surat.destroy', $surat->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Data surat belum tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection