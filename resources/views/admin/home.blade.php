@extends('admin.template')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .bg-berita { background: #60a5fa; }
    .bg-masukan { background: #fbbf24; }
    .bg-galeri { background: #a78bfa; }
    .bg-user { background: #34d399; }

    .card-dashboard {
        border-radius: 14px;
        transition: 0.3s;
    }

    .card-dashboard:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.15);
    }
</style>

<div class="container">

    {{-- Welcome --}}
    <div class="alert alert-primary">
        👋 Selamat datang, <strong>{{ auth()->user()->name }}</strong>
        <br>
        <small>Bekerja lah degan semangat &#128512;</small>
    </div>

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-md-6 col-lg-3 mb-3">
            <a href="{{ route('admin.berita') }}" class="text-decoration-none">
                <div class="card card-dashboard bg-berita text-white p-3 h-100">
                    <i class="fa-solid fa-newspaper fa-3x mb-2"></i>
                    <div class="text-end">
                        <h6>Berita</h6>
                        <h4 class="fw-bold">{{ $jmlBerita }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <a href="{{ route('admin.masukan') }}" class="text-decoration-none">
                <div class="card card-dashboard bg-masukan text-white p-3 h-100">
                    <i class="fa-solid fa-envelope-open-text fa-3x mb-2"></i>
                    <div class="text-end">
                        <h6>Masukan</h6>
                        <h4 class="fw-bold">{{ $jmlMasukan }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <a href="{{route('admin.galeri')}}" class="text-decoration-none">
                <div class="card card-dashboard bg-galeri text-white p-3 h-100">
                    <i class="fa-solid fa-images fa-3x mb-2"></i>
                    <div class="text-end">
                        <h6>Galeri</h6>
                        <h4 class="fw-bold">{{ $jmlGambar }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <a href="{{route('admin.user')}}" class="text-decoration-none">
                <div class="card card-dashboard bg-user text-white p-3 h-100">
                    <i class="fa-solid fa-users fa-3x mb-2"></i>
                    <div class="text-end">
                        <h6>User</h6>
                        <h4 class="fw-bold">{{ $jmlUser }}</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Data Terbaru --}}
    <div class="row">

        {{-- Berita Terbaru --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    📰 Berita Terbaru
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($beritaTerbaru as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $item->judul }}
                                <small class="text-muted">
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">
                                Belum ada berita
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Masukan Terbaru --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    📩 Masukan Terbaru
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($masukanTerbaru as $item)
                            <li class="list-group-item">
                                <strong>{{ $item->nama }}</strong><br>
                                <small class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($item->pesan, 60) }}
                                </small>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">
                                Belum ada masukan
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
