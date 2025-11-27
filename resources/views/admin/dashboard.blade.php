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
                    <table class="table table-striped mb-0 responsive-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama</th>
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
                                    <td data-label="Nama">{{ $tamu->nama }}</td>
                                    <td data-label="Alamat">{{ $tamu->alamat }}</td>
                                    <td data-label="No. Telepon">{{ $tamu->no_telepon ?? '-' }}</td>
                                    <td data-label="Keperluan">{{ $tamu->keperluan }}</td>
                                    <td data-label="Waktu Datang">{{ \Carbon\Carbon::parse($tamu->waktu_datang)->format('d M Y') }}</td>
                                    <td data-label="Foto">
                                        @if($tamu->foto_wajah)
                                            <img src="{{ asset('storage/' . $tamu->foto_wajah) }}" 
                                                 alt="Foto {{ $tamu->nama }}" 
                                                 class="img-thumbnail foto-zoom"
                                                 style="height: 50px; width: 50px; object-fit: cover; cursor: pointer;"
                                                 data-src="{{ asset('storage/' . $tamu->foto_wajah) }}">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td data-label="Aksi">
                                        <div class="d-flex flex-wrap gap-1">
                                            @if(isset($tamu->status) && $tamu->status === 'pending')
                                                <form action="{{ route('tamu.accept', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Accept"><i class="fas fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('tamu.reject', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject"><i class="fas fa-times"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('tamu.accept', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Accept"><i class="fas fa-check"></i></button>
                                                </form>
                                                @if(!isset($tamu->status) || $tamu->status === null)
                                                <form action="{{ route('tamu.pending', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Pending"><i class="fas fa-hourglass-half"></i></button>
                                                </form>
                                                @endif
                                                <form action="{{ route('tamu.reject', $tamu->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject"><i class="fas fa-times"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
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
    /* ============================================
       RESPONSIVE TABLE STYLES
       ============================================ */

    .table-responsive-custom {
        overflow-x: auto;
    }

    .responsive-table {
        width: 100%;
        border-collapse: collapse;
    }

    .responsive-table thead {
        background-color: #2c3e50;
        color: white;
    }

    .responsive-table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 0.95rem;
        white-space: nowrap;
        border-bottom: 2px solid #34495e;
    }

    .responsive-table td {
        padding: 15px;
        border-bottom: 1px solid #ecf0f1;
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
        max-width: 300px;
    }

    .responsive-table tbody tr {
        transition: background-color 0.3s ease;
    }

    .responsive-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Mobile Responsive - Stack Vertically */
    @media (max-width: 768px) {
        .responsive-table thead {
            display: none;
        }

        .responsive-table tbody,
        .responsive-table tr,
        .responsive-table td {
            display: block;
            width: 100%;
        }

        .responsive-table tr {
            margin-bottom: 20px;
            border: 1px solid #ecf0f1;
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .responsive-table td {
            padding: 12px 15px;
            text-align: right;
            padding-left: 40%;
            position: relative;
            border: none;
            border-bottom: 1px solid #ecf0f1;
            max-width: 100%;
        }

        .responsive-table td:last-child {
            border-bottom: none;
        }

        .responsive-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            font-weight: 600;
            color: #2c3e50;
            text-align: left;
            width: 35%;
            display: inline-block;
        }

        .responsive-table td[data-label="Aksi"] {
            padding-left: 15px;
            text-align: left;
        }

        .responsive-table td[data-label="Aksi"]::before {
            display: none;
        }

        .responsive-table td[data-label="Foto"] {
            text-align: center;
            padding-left: 15px;
        }

        .responsive-table td[data-label="Foto"]::before {
            display: none;
        }

        .responsive-table .foto-zoom {
            margin: 10px auto;
        }

        /* Stacking for long content */
        .responsive-table td[data-label="Alamat"],
        .responsive-table td[data-label="Keperluan"] {
            word-break: break-word;
            white-space: normal;
        }
    }

    /* Tablet Responsive */
    @media (min-width: 769px) and (max-width: 1024px) {
        .responsive-table td {
            padding: 12px;
            max-width: 150px;
            font-size: 0.9rem;
        }

        .responsive-table th {
            padding: 12px;
            font-size: 0.9rem;
        }
    }

    /* Desktop - Min adjustments */
    @media (min-width: 1025px) {
        .responsive-table td {
            max-width: 250px;
        }

        .responsive-table td[data-label="Keperluan"] {
            max-width: 300px;
        }
    }

    /* Text Ellipsis for long content on desktop */
    .responsive-table td {
        white-space: normal;
    }

    /* Aksi buttons responsive */
    .responsive-table td[data-label="Aksi"] .d-flex {
        flex-wrap: wrap;
        gap: 5px;
    }

    .responsive-table td[data-label="Aksi"] .btn {
        padding: 5px 10px;
        font-size: 0.85rem;
    }

    /* Better foto display */
    .responsive-table .img-thumbnail {
        border-radius: 6px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .responsive-table .img-thumbnail:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Empty state styling */
    .responsive-table tbody tr td[colspan] {
        text-align: center;
        padding: 40px 20px !important;
    }
</style>

<script>
document.querySelectorAll('.foto-zoom').forEach(function(img) {
    img.addEventListener('click', function() {
        var src = this.getAttribute('data-src');
        var modalImg = document.getElementById('zoomFotoImg');
        modalImg.src = src;
        var modal = new bootstrap.Modal(document.getElementById('zoomFotoModal'));
        modal.show();
    });
});
</script>
@endpush
@endsection
