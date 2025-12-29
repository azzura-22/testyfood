@extends('admin.template')

@section('title', 'Daftar Berita Admin')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif
<button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah Berita
    </button>
<div class="card-body table-responsive">
    <table id="beritaTable" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Gambar</th>
                <th>Author</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($berita as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->judul }}</td>

                    <td>
                        {{ Str::limit($b->isi, 100) }}
                    </td>

                    <td>
                        @if($b->gambar)
                            <img src="{{ asset('storage/fotoE/'.$b->gambar) }}"
                                width="80"
                                class="rounded">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>

                    <td>{{ $b->author }}</td>

                    <td>
                        <span class="badge bg-info text-dark">
                            {{ ucfirst($b->kategori) }}
                        </span>
                    </td>

                    <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d-m-Y') }}</td>

                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $b->id }}"
                        class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a class="btn btn-danger" href="{{route('admin.berita.delete',Crypt::encrypt($b->id))}}" onclick="return confirm('Hapus data ini?')">
                            delete
                        </a>
                    </td>
                </tr>

                {{-- Modal Edit Berita --}}
                    <div class="modal fade" id="editModal{{ $b->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Berita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <form action="{{ route('admin.berita.update', $b->id) }}"
                                    method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Judul Berita</label>
                                            <input type="text"
                                                name="judul"
                                                class="form-control"
                                                value="{{ $b->judul }}"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Isi Berita</label>
                                            <textarea name="isi"
                                                    class="form-control"
                                                    rows="4"
                                                    required>{{ $b->isi }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Gambar</label>
                                            <input type="file" name="gambar" class="form-control">

                                            @if($b->gambar)
                                                <small class="text-muted d-block mt-1">
                                                    Gambar saat ini:
                                                </small>
                                                <img src="{{ asset('storage/berita/'.$b->gambar) }}"
                                                    width="100"
                                                    class="rounded mt-1">
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label>Author</label>
                                            <input type="text"
                                                name="author"
                                                class="form-control"
                                                value="{{ $b->author }}"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Kategori</label>
                                            <select name="kategori" class="form-control" required>
                                                <option value="makanan" {{ $b->kategori == 'makanan' ? 'selected' : '' }}>
                                                    Makanan
                                                </option>
                                                <option value="minuman" {{ $b->kategori == 'minuman' ? 'selected' : '' }}>
                                                    Minuman
                                                </option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <input type="date"
                                                name="tanggal"
                                                class="form-control"
                                                value="{{ $b->tanggal }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Update</button>
                                        <button type="button"
                                                class="btn btn-secondary"
                                            data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
            {{-- modal tambah --}}
            <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Berita</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{route('berita.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama Berita</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Isi berita</label>
                                <input type="text" name="isi" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Author</label>
                                <input type="text" name="author" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control" required>
                                    <option value="minuman">minuman</option>
                                    <option value="makanan">makanan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    {{-- </form> --}}
                    </div>
                </div>
            </div>
        </tbody>
    </table>
</div>
@endsection
