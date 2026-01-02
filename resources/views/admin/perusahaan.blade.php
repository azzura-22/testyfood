@extends('admin.template')

@section('content')

{{-- ================= BUTTON TAMBAH PROFILE ================= --}}
@if ($perusahaan->count() < 1)
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
    + Tambah Profile
</button>
@else
<div class="alert alert-info mb-3">
    Anda sudah memiliki profile perusahaan
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- ================= TABLE ================= --}}
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($perusahaan as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->nama }}</td>
                    <td>{{ Str::limit($t->visi, 50) }}</td>
                    <td>{{ Str::limit($t->misi, 50) }}</td>
                    <td>{{ $t->gmail }}</td>
                    <td>{{ $t->no_hp }}</td>
                    <td>{{ Str::limit($t->deskripsi, 100) }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $t->id }}">
                            Edit
                        </button>

                        <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#gambarModal{{ $t->id }}">
                            Tambah Gambar
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>

{{-- ================= MODAL CREATE ================= --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('perusahaan.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Profile Perusahaan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama perusahaan" required>
                    <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi" required></textarea>
                    <input type="text" name="visi" class="form-control mb-2" placeholder="Visi" required>
                    <input type="text" name="misi" class="form-control mb-2" placeholder="Misi" required>
                    <input type="email" name="gmail" class="form-control mb-2" placeholder="Email" required>
                    <input type="text" name="no_hp" class="form-control" placeholder="No HP" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
@foreach($perusahaan as $t)
<div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{route('perusahaan.update',$t->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile Perusahaan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" name="nama" class="form-control mb-2" value="{{ $t->nama }}" required>
                    <textarea name="deskripsi" class="form-control mb-2" required>{{ $t->deskripsi }}</textarea>
                    <input type="text" name="visi" class="form-control mb-2" value="{{ $t->visi }}" required>
                    <input type="text" name="misi" class="form-control mb-2" value="{{ $t->misi }}" required>
                    <input type="email" name="gmail" class="form-control mb-2" value="{{ $t->gmail }}" required>
                    <input type="text" name="no_hp" class="form-control" value="{{ $t->no_hp }}" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endforeach

{{-- ================= MODAL TAMBAH GAMBAR ================= --}}
@foreach($perusahaan as $t)
<div class="modal fade" id="gambarModal{{ $t->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('perusahaan.gambar.store', $t->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gambar Perusahaan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="file" name="nama_file" class="form-control mb-2" required>
                    <select name="tipe" class="form-control" required>
                        <option value="profil">Profil</option>
                        <option value="visi">Visi</option>
                        <option value="misi">Misi</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endforeach
{{-- ================= TABLE GAMBAR PERUSAHAAN ================= --}}
<div class="card mt-4">
    <div class="card-header">
        <h5>Data Gambar Perusahaan</h5>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipe</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($perusahaan as $p)
                @foreach($p->gambartentangs as $g)
                <tr>
                    <td>{{ $g->id }}</td>
                    <td>{{ ucfirst($g->tipe) }}</td>
                    <td>
                        <img src="{{ asset('storage/tentang/'.$g->nama_file) }}"
                             width="120"
                             class="img-thumbnail">
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{route('perusahaan.gambar.delete',$g->id)}}" onclick="return confirm('Yakin ingin menghapus data ini?')">delete</a>
                    </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
