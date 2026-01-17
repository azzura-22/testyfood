@extends('template')

@section('title','Home - Tasty Food')

@section('content')
<style>
.benermenu {
    background: url('{{ asset("asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/Group 70.png") }}')
        center / cover no-repeat;
    min-height: 420px;
    padding: 140px 0 100px;
    position: relative;
}

.benermenu::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.35);
}

.benermenu .container {
    position: relative;
    z-index: 2;
}

/* ================= MENU CARD ================= */
.menu-card {
    background: #fff;
    border-radius: 18px;
    padding-top: 80px;
    text-align: center;
    height: 100%;
    position: relative;
    box-shadow: 0 15px 30px rgba(0,0,0,.15);
}

/* Foto Lingkaran */
.menu-img-wrapper {
    position: absolute;
    top: -65px;
    left: 50%;
    transform: translateX(-50%);
    width: 130px;
    height: 130px;
    background: #fff;
    border-radius: 50%;
    padding: 6px;
    box-shadow: 0 12px 25px rgba(0,0,0,.25);
}

.menu-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

/* Hover efek (opsional) */
.menu-card:hover .menu-img-wrapper {
    transform: translateX(-50%) translateY(-6px);
    transition: .3s ease;
}
</style>

@php
use App\Models\Berita;
    $beritabesar = Berita::first();
    $beritakecil = Berita::take(4)->get();
@endphp


{{-- ================= HERO ================= --}}
<section class="home-hero py-5">
    <div class="container">
        <div class="row align-items-center">

            {{-- TEXT --}}
            <div class="col-md-6 hero-text">
                <h1>HEALTHY</h1>
                <h1 class="hero-title fw-bold">TASTY FOOD</h1>

                <p class="mt-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Phasellus ornare augue eu rutrum commodo.
                </p>

                <a href="/tentang" class="btn btn-dark px-4 py-2 mt-3">
                    TENTANG KAMI
                </a>
            </div>

            {{-- IMAGE --}}
            <div class="col-md-6 text-end">
                <img src="{{ asset('asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/img-4-2000x2000.png') }}"
                     class="img-fluid hero-img">
            </div>

        </div>
    </div>
</section>

{{-- ================= TENTANG KAMI ================= --}}
<section class="tentang py-5 text-center">
    <div class="container">
        <h2 class="fw-bold">TENTANG KAMI</h2>
        <p class="mt-3 mx-auto" style="max-width:600px">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Phasellus ornare augue eu rutrum commodo.
        </p>
    </div>
</section>

{{-- ================= MENU CARD ================= --}}
<section class="menu bg-light">
    <div class="benermenu container-fluid">
        <div class="container">
            <div class="row g-4 justify-content-center">

                @php
                    $images = [
                        'img-1.png',
                        'img-2.png',
                        'img-3.png',
                        'img-4.png'
                    ];
                @endphp

                @foreach ($images as $img)
                <div class="col-md-3 col-sm-6">
                    <div class="menu-card">
                        <div class="menu-img-wrapper">
                            <img src="{{ asset('asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/'.$img) }}" class="menu-img">
                        </div>

                        <div class="card-body">
                            <h5 class="fw-bold mt-3">LOREM IPSUM</h5>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



{{-- ================= BERITA ================= --}}
<section class="berita py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">BERITA KAMI</h2>

        <div class="row g-4">

            {{-- ================= BERITA BESAR ================= --}}
            @if($utama)
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ asset('storage/fotoE/'.$utama->gambar) }}"
                         class="card-img-top"
                         style="height:260px; object-fit:cover;">

                    <div class="card-body">
                        <h5 class="fw-bold">
                            {{ $utama->judul }}
                        </h5>

                        <p class="text-muted small">
                            {{ $utama->author }} ·
                            {{ \Carbon\Carbon::parse($utama->tanggal)->format('d M Y') }}
                        </p>

                        <p>
                            {{ Str::limit($utama->isi, 240) }}
                        </p>

                        <a href="{{ route('berita.show', Crypt::encrypt($utama->id)) }}"
                           class="text-warning text-decoration-none fw-semibold">
                            Baca selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- ================= BERITA KECIL ================= --}}
            <div class="col-md-6">
                <div class="row g-4">

                    @foreach($lainnya as $bk)
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/fotoE/'.$bk->gambar) }}"
                                 class="card-img-top"
                                 style="height:120px; object-fit:cover;">

                            <div class="card-body">
                                <h6 class="fw-bold">
                                    {{ Str::limit($bk->judul, 50) }}
                                </h6>

                                <p class="small text-muted">
                                    {{ Str::limit($bk->isi, 60) }}
                                </p>

                                <a href="{{ route('berita.show', Crypt::encrypt($bk->id)) }}"
                                   class="text-warning small text-decoration-none fw-semibold">
                                    Baca selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</section>


{{-- ================= GALERI ================= --}}
<section class="galeri py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">GALERI KAMI</h2>

        <div class="row g-3">
            @foreach ($gambar as $hideng )
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('storage/galeri/'.$hideng->path) }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{route('galeri')}}" class="btn btn-dark px-4">
                LIHAT LEBIH BANYAK
            </a>
        </div>
    </div>
</section>

@endsection
