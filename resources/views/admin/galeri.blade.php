@extends('admin.template')

@section('content')
<div class="container py-5">

    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addModal">
        + Tambah galeri
    </button>

    <h2 class="text-center mb-4">Galeri</h2>

    <div class="row g-4">
        @foreach($galeri as $item)
        <div class="col-md-4">
            <div class="card shadow-sm rounded-4 h-100">

                {{-- FOTO --}}
                @if($item->tipe == 'foto')
                    <img src="{{ asset('storage/galeri/' . $item->path) }}"
                         class="card-img-top rounded-top-4"
                         alt="foto">

                {{-- VIDEO --}}
                @elseif($item->tipe == 'vidio')
                    <div class="ratio ratio-16x9">
                        <video controls class="rounded-top-4 w-100">
                            <source src="{{ asset('storage/galeri/' . $item->path) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </div>
                @endif

                <div class="card-body">
                    <a class="btn btn-danger btn-sm"
                       href="{{ route('admin.deletegaleri', Crypt::encrypt($item->id)) }}"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Delete
                    </a>

                    <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->id }}">
                        Edit
                    </button>
                </div>

                <div class="card-footer text-muted small">
                    {{ \Carbon\Carbon::parse($item->timestamp)->format('d M Y') }}
                </div>
            </div>
        </div>

        {{-- ================= MODAL EDIT ================= --}}
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{route('galeri.update', Crypt::encrypt($item->id)) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="mb-3">
                                <label>File</label>
                                <input type="file" name="path" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Tipe</label>
                                <select name="tipe" class="form-control" required>
                                    <option value="foto" {{ $item->tipe == 'foto' ? 'selected' : '' }}>Foto</option>
                                    <option value="vidio" {{ $item->tipe == 'vidio' ? 'selected' : '' }}>Video</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        {{-- ================= END MODAL EDIT ================= --}}
        @endforeach
    </div>
</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label>File</label>
                        <input type="file" name="path" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tipe</label>
                        <select name="tipe" class="form-control" required>
                            <option value="foto">Foto</option>
                            <option value="vidio">Video</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- ================= END MODAL TAMBAH ================= --}}
@endsection
