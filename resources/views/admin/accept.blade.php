@extends('admin.layout')

@section('content')

    <style>
    /* Biar teks panjang turun ke bawah (wrap) */
    .table td,
    .table th {
        white-space: normal !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }

    /* Supaya kolom tidak maksa lebar */
    .table {
        table-layout: fixed !important;
    }
</style>


    <div class="container py-4">
        <h2 class="mb-4"><i class="fas fa-check-circle text-success"></i> Daftar Tamu Diterima (Accept)</h2>
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Keperluan</th>
                                <th>Waktu Datang</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tamus as $tamu)
                                <tr>
                                    <td>{{ $tamu->nama }}</td>
                                    <td>{{ $tamu->email ?? '-' }}</td>
                                    <td>{{ $tamu->alamat ?? '-' }}</td>
                                    <td>{{ $tamu->no_telepon ?? '-' }}</td>
                                    <td>{{ $tamu->keperluan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tamu->waktu_datang)->format('d M Y') }}</td>
                                    <td>
                                        @if($tamu->foto_wajah)
                                            <img src="{{ asset('storage/' . $tamu->foto_wajah) }}" alt="Foto {{ $tamu->nama }}" class="img-thumbnail" style="height: 50px; width: 50px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p class="mb-0">Belum ada tamu yang diterima</p>
                                        </div>
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
