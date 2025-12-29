@extends('admin.template')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .bg-berita { background: #60a5fa; }
    .bg-masukan { background: #fbbf24; }
    .bg-galeri { background: #a78bfa; }
</style>

<div class="container">
    <div class="row">

        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.berita') }}" class="text-decoration-none">
                <div class="card bg-berita text-white p-3">
                    <div class="d-flex flex-column h-100 justify-content-between">
                        <i class="fa-solid fa-newspaper fa-3x"></i>
                        <div class="text-end">
                            <h6 class="mb-1">Berita</h6>
                            <h5></h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.masukan') }}" class="text-decoration-none">
                <div class="card bg-masukan text-white p-3">
                    <div class="d-flex flex-column h-100 justify-content-between">
                        <i class="fa-solid fa-envelope-open-text fa-3x"></i>
                        <div class="text-end">
                            <h6 class="mb-1">Masukan</h6>
                            <h5></h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none">
                <div class="card bg-galeri text-white p-3">
                    <div class="d-flex flex-column h-100 justify-content-between">
                        <i class="fa-solid fa-images fa-3x"></i>
                        <div class="text-end">
                            <h6 class="mb-1">Galeri</h6>
                            <h5></h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
