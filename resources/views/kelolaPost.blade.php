@extends('templatePost')

@section('title','Kelola Postingan')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif
<div class="container py-4">

    <h3 class="fw-bold mb-4">Kelola Postingan</h3>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Postingan
    </button>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $post)
            <tr>
                <td>{{ $post->judul }}</td>
                <td>{{ ucfirst($post->kategori) }}</td>
                <td>{{ \Carbon\Carbon::parse($post->tanggal)->format('d M Y') }}</td>
                <td>
                    <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#edit{{ $post->id }}">
                        Edit
                    </button>

                    <button class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#hapus{{ $post->id }}">
                        Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('posting.tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="mb-2">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Isi</label>
                        <textarea name="isi" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-2">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
@foreach ($data as $post)
<div class="modal fade" id="edit{{ $post->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('posting.ubah',$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-2">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{ $post->judul }}" required>
                    </div>

                    <div class="mb-2">
                        <label>Isi</label>
                        <textarea name="isi" class="form-control" rows="4" required>{{ $post->isi }}</textarea>
                    </div>

                    <div class="mb-2">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control">
                            <option value="makanan" {{ $post->kategori=='makanan'?'selected':'' }}>Makanan</option>
                            <option value="minuman" {{ $post->kategori=='minuman'?'selected':'' }}>Minuman</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                        @if($post->gambar)
                            <small class="text-muted">
                                Gambar saat ini: {{ $post->gambar }}
                            </small>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- ================= MODAL HAPUS ================= --}}
@foreach ($data as $post)
<div class="modal fade" id="hapus{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('posting.hapus',$post->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    Yakin hapus postingan
                    <strong>{{ $post->judul }}</strong>?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
