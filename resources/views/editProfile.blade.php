@extends('templatePost')

@section('title','Setting Profile')

@section('content')

<h3 class="fw-bold mb-4">Setting Profile</h3>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('posting.update', $post->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Bio</label>
                    <input type="text" name="bio" class="form-control" value="{{ old('bio', $post->bio) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Usia</label>
                    <input type="number" name="usia" class="form-control" value="{{ old('usia', $post->usia) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="laki-laki" {{ $post->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ $post->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Foto Profile</label>
                    <input type="file" name="image_path" class="form-control">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

@endsection
