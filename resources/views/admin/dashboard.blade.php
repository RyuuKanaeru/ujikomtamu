@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-list"></i> Daftar Tamu</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table responsive-table">
                    <thead>
                        <tr>
                            <th>No</th>
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
                            <td data-label="No">{{ $loop->iteration }}</td>
                            <td data-label="Nama">{{ $tamu->nama }}</td>
                            <td data-label="Email">{{ $tamu->email ?? '-' }}</td>
                            <td data-label="Alamat">{{ $tamu->alamat }}</td>
                            <td data-label="No. Telepon">{{ $tamu->no_telepon ?? '-' }}</td>
                            <td data-label="Keperluan">{{ $tamu->keperluan }}</td>
                            <td data-label="Waktu Datang">{{ \Carbon\Carbon::parse($tamu->waktu_datang)->format('d M Y') }}</td>
                            <td data-label="Foto">
                                @if($tamu->foto_wajah)
                                    <img src="{{ asset('storage/' . $tamu->foto_wajah) }}" 
                                        alt="Foto {{ $tamu->nama }}" 
                                        class="img-thumbnail foto-zoom"
                                        style="height:50px;width:50px;object-fit:cover;cursor:pointer;"
                                        data-src="{{ asset('storage/' . $tamu->foto_wajah) }}">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td data-label="Aksi">
                                <div class="d-flex flex-wrap gap-1">
                                    <!-- Accept -->
                                    <form action="{{ route('admin.tamu.accept', $tamu->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Terima permintaan dari {{ $tamu->nama }}?')">
                                        @csrf
                                        <button type="submit" class="action-icon action-accept" title="Terima">
                                            <svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" /></svg>
                                        </button>
                                    </form>

                                    <!-- Pending -->
                                    <form action="{{ route('admin.tamu.pending', $tamu->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tandai sebagai sedang diproses?')">
                                        @csrf
                                        <button type="submit" class="action-icon action-pending" title="Sedang Diproses">
                                            <svg viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10"/>
                                                <path d="M12 6v6l4 2"/>
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Reject -->
                                    <form action="{{ route('admin.tamu.reject', $tamu->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tolak permintaan dari {{ $tamu->nama }}?')">
                                        @csrf
                                        <button type="submit" class="action-icon action-reject" title="Tolak">
                                            <svg viewBox="0 0 24 24">
                                                <line x1="6" y1="6" x2="18" y2="18"/>
                                                <line x1="6" y1="18" x2="18" y2="6"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">Belum ada tamu yang tercatat</p>
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

<!-- Modal Zoom Foto -->
<div class="modal fade" id="zoomFotoModal" tabindex="-1" aria-labelledby="zoomFotoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="zoomFotoLabel">Foto Wajah Tamu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="zoomFotoImg" src="#" alt="Zoom Foto" style="max-width:100%; max-height:70vh; border-radius:10px;">
      </div>
    </div>
  </div>
</div>

@push('scripts')
<style>
/* =========================
   TABLE & RESPONSIVE
========================= */
.table-responsive-custom { 
    overflow-x:auto; 
}

.responsive-table {
    width: 100%;
    border-collapse: collapse;
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 4px 15px rgba(0,0,0,0.05);
    table-layout: fixed; /* kunci supaya kolom ga melebar */
    word-wrap: break-word; /* teks panjang wrap ke bawah */
}

.responsive-table th, .responsive-table td {
    border:1px solid rgba(0,0,0,0.1);
    padding:12px 15px;
    font-size:0.95rem;
    max-width:200px;
    overflow-wrap: break-word;
}

/* Atur lebar kolom spesifik */
.responsive-table th:nth-child(1),
.responsive-table td:nth-child(1) {
    width: 70px; /* kolom No lebih kecil */
}

.responsive-table th:nth-child(5),
.responsive-table td:nth-child(5) {
    width: 300px; /* kolom Keperluan lebih besar */
}

.responsive-table th {
    background:#f0fff7;
    color:#004d2f;
    font-weight:600;
}

.responsive-table tbody tr:hover {
    background:#f8f9fa;
}

.responsive-table .img-thumbnail {
    border-radius:6px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.responsive-table .img-thumbnail:hover {
    transform: scale(1.1);
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
}

/* ACTION ICON BUTTONS */
.action-icon {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:36px; height:36px;
    border-radius:8px;
    background:#fff;
    border:2px solid #00ff7f;
    cursor:pointer;
    padding:0;
    transition: all 0.3s ease;
}

.action-icon svg {
    width:18px; height:18px;
    fill:none;
    stroke:#00ff7f;
    stroke-width:2;
    transition: all 0.3s ease;
}

.action-icon:hover {
    background:#00ff7f;
}

.action-icon:hover svg {
    fill:#fff;
    stroke:#004d2f;
}

/* Accept Button - Green */
.action-accept {
    border-color:#28a745;
}

.action-accept svg {
    stroke:#28a745;
}

.action-accept:hover {
    background:#28a745;
    border-color:#28a745;
}

.action-accept:hover svg {
    stroke:#fff;
}

/* Pending Button - Blue */
.action-pending {
    border-color:#007bff;
}

.action-pending svg {
    stroke:#007bff;
}

.action-pending:hover {
    background:#007bff;
    border-color:#007bff;
}

.action-pending:hover svg {
    stroke:#fff;
}

/* Reject Button - Red */
.action-reject {
    border-color:#dc3545;
}

.action-reject svg {
    stroke:#dc3545;
}

.action-reject:hover {
    background:#dc3545;
    border-color:#dc3545;
}

.action-reject:hover svg {
    stroke:#fff;
}

/* RESPONSIVE */
@media (max-width:768px) {
    .responsive-table thead { display:none; }
    .responsive-table tbody, .responsive-table tr, .responsive-table td { display:block; width:100%; }
    .responsive-table tr { margin-bottom:20px; border:1px solid #ecf0f1; border-radius:8px; overflow:hidden; background:#fff; }
    .responsive-table td { padding:12px 15px; text-align:right; padding-left:40%; position:relative; border:none; border-bottom:1px solid #ecf0f1; }
    .responsive-table td:last-child { border-bottom:none; }
    .responsive-table td::before { content:attr(data-label); position:absolute; left:15px; font-weight:600; color:#2c3e50; width:35%; text-align:left; display:inline-block; }
    .responsive-table td[data-label="Aksi"]::before { display:none; text-align:left; padding-left:15px; }
    .responsive-table td[data-label="Foto"]::before { display:none; text-align:center; padding-left:15px; }
}

/* EMPTY STATE */
.responsive-table tbody tr td[colspan] { text-align:center; padding:40px 20px !important; }

</style>

<script>
document.querySelectorAll('.foto-zoom').forEach(img=>{
    img.addEventListener('click',function(){
        document.getElementById('zoomFotoImg').src = this.getAttribute('data-src');
        new bootstrap.Modal(document.getElementById('zoomFotoModal')).show();
    });
});
</script>
@endpush
@endsection
