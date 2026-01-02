@extends('layout')

@section('title','Tentang Kami')

@section('content')

<style>
/* ================= HERO ================= */
.hero-tentang{
    height:500px;
    background:url('{{ asset("asset/food/WEBSITE MAGANG (TASTY FOOD)/ASET/Group 70.png") }}') center/cover no-repeat;
    position: relative;
}
.hero-tentang::after{
    content:'';
    position:absolute;
    inset:0;
    background: rgba(0,0,0,.55);
}
.hero-content{
    position: relative;
    z-index: 2;
    padding-top:120px;
    color:#fff;
}

/* ================= GENERAL ================= */
.section-padding{
    padding:80px 0;
}
.bg-soft{
    background:#edecec;
}
.section-title{
    font-weight:700;
    margin-bottom:16px;
}

/* ================= TITLE ACCENT ================= */
.title-accent{
    position: relative;
    padding-left:14px;
}
.title-accent::before{
    content:'';
    position:absolute;
    left:0;
    top:2px;
    height:100%;
    width:4px;
    background:#d4a373;
    border-radius:2px;
}
.text-accent{
    color:#d4a373;
}

/* ================= IMAGE ================= */
.about-img{
    height:260px;
    object-fit:cover;
    width:100%;
}
</style>

{{-- ================= HERO ================= --}}
<div class="hero-tentang">
    <div class="container hero-content">
        <h1 class="fw-bold">Tentang Kami</h1>
        <p class="text-white-50 col-lg-6">
            Mengenal lebih dekat perjalanan dan nilai yang kami bangun bersama.
        </p>
    </div>
</div>

@php
    $dataTentang = $tentang->first();
    $imgProfil = $gambartentang->where('tipe','profil')->take(2);
    $imgVisi   = $gambartentang->where('tipe','visi')->take(2);
    $imgMisi   = $gambartentang->where('tipe','misi')->first();
@endphp

{{-- ================= ABOUT / TASTY FOOD (ABU-ABU) ================= --}}
<div class="bg-soft">
    <div class="container section-padding">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h5 class="section-title title-accent">
                    <span class="text-accent">TASTY</span> FOOD
                </h5>
                <p class="text-muted">
                    {{ $dataTentang->deskripsi ?? '-' }}
                </p>
            </div>

            <div class="col-lg-6">
                <div class="d-flex gap-3">
                    @forelse($imgProfil as $img)
                        <img src="{{ asset('storage/tentang/'.$img->nama_file) }}"
                             class="img-fluid rounded-4 shadow-sm about-img">
                    @empty
                        <img src="{{ asset('assets/img/default.jpg') }}"
                             class="img-fluid rounded-4 shadow-sm about-img">
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= VISI (PUTIH) ================= --}}
<div class="container section-padding">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="d-flex gap-3">
                @forelse ($imgVisi as $g)
                    <img src="{{ asset('storage/tentang/'.$g->nama_file) }}"
                         class="img-fluid rounded-4 shadow-sm about-img">
                @empty
                    <img src="{{ asset('assets/img/default.jpg') }}"
                         class="img-fluid rounded-4 shadow-sm about-img">
                @endforelse
            </div>
        </div>

        <div class="col-lg-6">
            <h5 class="section-title title-accent">VISI</h5>
            <p class="text-muted">
                {{ $dataTentang->visi ?? '-' }}
            </p>
        </div>
    </div>
</div>


{{-- ================= MISI (PUTIH) ================= --}}
<div class="container section-padding">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h5 class="section-title title-accent">MISI</h5>
            <ul class="text-muted ps-3">
                @foreach(explode("\n", $dataTentang->misi ?? '') as $m)
                    <li>{{ $m }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-lg-6">
            @if($imgMisi)
                <img src="{{ asset('storage/tentang/'.$imgMisi->nama_file) }}"
                     class="img-fluid rounded-4 shadow-sm">
            @endif
        </div>
    </div>
</div>

{{-- ================= NILAI KAMI (ABU-ABU) ================= --}}
<div class="bg-soft">
    <div class="container section-padding">
        <div class="row text-center">
            <div class="col-12 mb-4">
                <h5 class="section-title title-accent">NILAI KAMI</h5>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <h6 class="fw-bold">Kualitas</h6>
                    <p class="text-muted small">
                        Kami menjaga standar kualitas terbaik di setiap sajian.
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <h6 class="fw-bold">Kepercayaan</h6>
                    <p class="text-muted small">
                        Kepercayaan pelanggan adalah prioritas utama kami.
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <h6 class="fw-bold">Inovasi</h6>
                    <p class="text-muted small">
                        Kami terus berkembang mengikuti tren dan kebutuhan pasar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
