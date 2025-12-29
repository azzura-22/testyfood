@extends('admin.template')
@section('content')
@if ($perusahaan->count() < 1)
<button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah profile
    </button>
@else
anda sudah memiliki profile perusahaan
@endif
<div class="card-body table-responsive">
    <table id="perusahaanTable" class="table table-striped table-bordered nowrap" style="width:100%">
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
                        <a href="#" class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $t->id }}">
                        Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Berita</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{route('perusahaan.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama perusahaan</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="deskripsi" cols="60" rows="10">deskripsi perusahaan</textarea>
                            </div>
                            <div class="mb-3">
                                <label>visi</label>
                                <input type="text" name="visi" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>misi</label>
                                <input type="text" name="misi" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>gmail</label>
                                <input type="text" name="gmail" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>no_hp</label>
                                <input type="text" name="no_hp" class="form-control" required>
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
