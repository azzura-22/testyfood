@extends('layout')

@section('title','Kontak Kami')

@section('content')

<style>
.hero-kontak{
    height:340px;
    background:url('{{ asset("asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/Group 70.png") }}')
               center/cover no-repeat;
    position: relative;
    z-index: 1;
    color:#fff;
}
.hero-kontak::after{
    content:'';
    position:absolute;
    inset:0;
    background: rgba(0,0,0,.55);
    z-index: 1;
}
.hero-kontak .hero-content{
    position: relative;
    z-index: 2;
    padding-top: 120px;
}
.card{
    transition:.3s;
}
.card:hover{
    transform: translateY(-5px);
}
</style>

{{-- HERO --}}
<div class="hero-kontak">
    <div class="container hero-content">
        <h1 class="fw-bold">BERITA</h1>
    </div>
</div>

{{-- ===============================
   CONTENT
================================ --}}

@if (empty($utama) && $lainnya->isEmpty())

<div class="container my-5">
    <h3 class="text-center text-muted">
        Sebentar lagi akan ditambahkan berita
    </h3>
</div>

@else

{{-- ================= BERITA UTAMA ================= --}}
@if($utama)
<section class="container my-5">
    <div class="row align-items-center g-5">

        <div class="col-md-6">
            <img src="{{ asset('storage/fotoE/'.$utama->gambar) }}"
                 class="img-fluid rounded-4 shadow"
                 style="height:350px; object-fit:cover;">
        </div>

        <div class="col-md-6">
            <h3 class="fw-bold">{{ $utama->judul }}</h3>

            <p class="text-muted small">
                {{ $utama->author }} ·
                {{ \Carbon\Carbon::parse($utama->tanggal)->format('d M Y') }}
            </p>

            <span class="badge bg-warning text-dark mb-3">
                {{ ucfirst($utama->kategori) }}
            </span>

            <p>{{ Str::limit($utama->isi, 250) }}</p>

            <a href="{{ route('berita.show', Crypt::encrypt($utama->id)) }}"
               class="btn btn-dark rounded-0 px-4">
                BACA SELENGKAPNYA
            </a>
        </div>

    </div>
</section>
@endif

{{-- ================= BERITA LAINNYA ================= --}}
@if($lainnya->isNotEmpty())
<section class="container my-5">
    <h4 class="fw-bold mb-4">BERITA LAINNYA</h4>

    <div class="row g-4">
        @foreach($lainnya as $b)
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm rounded-4">
                <img src="{{ asset('storage/fotoE/'.$b->gambar) }}"
                     class="card-img-top rounded-top-4"
                     style="height:180px; object-fit:cover;">

                <div class="card-body">
                    <h6 class="fw-bold">{{ $b->judul }}</h6>
                    <p class="text-muted small">
                        {{ Str::limit($b->isi, 80) }}
                    </p>
                    <a href="{{ route('berita.show', Crypt::encrypt($b->id)) }}"
                       class="text-warning text-decoration-none small fw-semibold">
                        Baca selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

@endif

@endsection
