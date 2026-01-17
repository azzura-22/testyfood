@extends('layout')

@section('title','Tentang Kami')

@section('content')

<style>
/* ================= HERO ================= */
.hero {
    height: 520px;
    background: url('{{ asset("asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/Group 70.png") }}')
        center / cover no-repeat;
    position: relative;
}
.hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.55);
}
.hero-inner {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
    color: #fff;
}
.hero-inner h1 {
    font-size: 3rem;
    font-weight: 800;
}

/* ================= GENERAL ================= */
.section {
    padding: 100px 0;
}
.section-soft {
    background: #f4f4f4;
}
.section-title {
    font-weight: 700;
    margin-bottom: 20px;
}
.text-muted {
    line-height: 1.8;
}

/* ================= IMAGE ================= */
.img-portrait {
    height: 420px;
    width: 100%;
    object-fit: cover;
    border-radius: 18px;
}
.img-landscape {
    height: 260px;
    width: 100%;
    object-fit: cover;
    border-radius: 18px;
}

/* ================= GRID ================= */
.grid-2 {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 20px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .hero-inner h1 {
        font-size: 2.2rem;
    }
    .section {
        padding: 60px 0;
    }
    .grid-2 {
        grid-template-columns: 1fr;
    }
}
</style>

{{-- ================= HERO ================= --}}

@php
    $dataTentang = $tentang->first();
    $imgProfil = $gambartentang->where('tipe','profil')->take(2);
    $imgVisi = $gambartentang->where('tipe','visi')->take(2);
    $imgMisi = $gambartentang->where('tipe','misi')->first();
@endphp
<section class="hero">
    <div class="container hero-inner">
        <div>
            <small class="text-uppercase text-white-50">Tasty Food</small>
            <h1 class="mt-2">Tentang Kami</h1>
        </div>
    </div>
</section>

{{-- ================= ABOUT ================= --}}
<section class="section">
    <div class="container">
        <div class="row align-items-center">

            {{-- TEXT --}}
            <div class="col-lg-6">
                <h5 class="section-title">TASTY FOOD</h5>
                <p class="text-muted">
                    {{ $dataTentang->deskripsi ?? '-' }}
                </p>
            </div>

            {{-- IMAGE (2 FOTO) --}}
            <div class="col-lg-6">
                <div class="grid-2">
                    @foreach ($imgProfil as $img)
                        <img src="{{ asset('storage/tentang/'.$img->nama_file) }}"
                             class="img-portrait">
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================= VISI ================= --}}
<section class="section section-soft">
    <div class="container">
        <div class="row align-items-center">

            {{-- IMAGE (2 FOTO) --}}
            <div class="col-lg-6">
                <div class="grid-2">
                    @foreach ($imgVisi  as $img)
                        <img src="{{ asset('storage/tentang/'.$img->nama_file) }}"
                             class="img-landscape">
                    @endforeach
                </div>
            </div>

            {{-- TEXT --}}
            <div class="col-lg-6">
                <h5 class="section-title">VISI</h5>
                <p class="text-muted">
                    {{ $dataTentang->visi ?? '-' }}
                </p>
            </div>

        </div>
    </div>
</section>

{{-- ================= MISI ================= --}}
<section class="section">
    <div class="container">
        <div class="row align-items-center">

            {{-- TEXT --}}
            <div class="col-lg-6">
                <h5 class="section-title">MISI</h5>

                {{-- Jika misi berupa paragraf --}}
                <p class="text-muted">
                    {{ $dataTentang->misi ?? '-' }}
                </p>

                {{-- Jika misi ingin list (opsional) --}}
                {{--
                <ul class="text-muted ps-3">
                    @foreach(explode("\n", $dataTentang->misi ?? '') as $m)
                        @if(trim($m) !== '')
                            <li>{{ $m }}</li>
                        @endif
                    @endforeach
                </ul>
                --}}
            </div>

            {{-- IMAGE (DINAMIS DARI $imgMisi) --}}
            <div class="col-lg-6">
                @if ($imgMisi)
                    <img src="{{ asset('storage/tentang/'.$imgMisi->nama_file) }}"
                         class="img-landscape">
                @else
                    <img src="{{ asset('assets/img/default.jpg') }}"
                         class="img-landscape">
                @endif
            </div>

        </div>
    </div>
</section>

@endsection
