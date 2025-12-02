@extends('admin.layout')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4"><i class="fas fa-times text-danger"></i> Daftar Tamu Ditolak (Reject)</h2>
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
                                <th>Aksi</th>
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
                                    <td>
                                        <form id="delete-form-{{ $tamu->id }}" action="{{ route('tamu.destroy', $tamu->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $tamu->id }}, '{{ $tamu->nama }}')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p class="mb-0">Belum ada tamu ditolak</p>
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

@push('scripts')
<script>
    function confirmDelete(tamuId, tamuName) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus data tamu "${tamuName}"? Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + tamuId).submit();
            }
        });
    }
</script>
@endpush
