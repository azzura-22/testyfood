<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Tasty Food')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
    /* ===============================
       GLOBAL
    =============================== */
    body{
        font-family:'Poppins', sans-serif;
        background:#F2F2F2;
        color:#333;
        margin:0;
        padding:0;
    }

    /* ===============================
       NAVBAR
    =============================== */
    .navbar{
        background:transparent;
        padding:25px 0; /* JARAK DESKTOP TETAP */
        position:fixed;
        width:100%;
        z-index:10;
        transition: background-color .3s ease, box-shadow .3s ease;
    }

    .navbar-brand,
    .nav-link{
        color:#333 !important;
        font-size:14px;
        letter-spacing:1px;
        font-weight:500;
    }

    .navbar.scrolled{
        background:#ffffff !important;
        box-shadow:0 4px 12px rgba(0,0,0,.08);
    }

    .navbar-toggler-icon{
        filter: invert(1);
    }

    /* ===============================
       HERO
    =============================== */
    .home-hero{
        min-height:100vh;
        display:flex;
        align-items:center;
        position:relative;
        overflow:hidden;
    }

    .hero-title{
        font-size:52px;
        font-weight:700;
        line-height:1.2;
        color:#222;
    }

    .hero-img{
        position:absolute;
        right:-183px;
        top:210px;
        transform:translateY(-50%);
        max-height:90vh;
    }

    /* ===============================
       FOOTER
    =============================== */
    .footer-dark {
        background: radial-gradient(circle at top, #1b1b1b, #000);
        color: #fff;
    }

    .footer-dark p {
        line-height: 1.8;
    }

    .footer-link li {
        margin-bottom: 8px;
    }

    .footer-link a {
        color: #bdbdbd;
        text-decoration: none;
        font-size: 14px;
    }

    .footer-link a:hover {
        color: #fff;
    }

    .footer-contact li {
        color: #bdbdbd;
        font-size: 14px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .social-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
    }

    .social-icon.facebook { background: #3b5998; }
    .social-icon.twitter { background: #1da1f2; }

    .footer-dark .text-muted {
        color:#ffffff !important;
    }

    /* ===============================
       RESPONSIVE
    =============================== */

    /* DESKTOP - POSISI MENU SEPERTI SCREENSHOT */
    @media (min-width: 992px){
        .navbar-nav{
            flex-direction: row;
            align-items: center;
            margin-left: 60px; /* JARAK MENU DARI LOGO */
        }
    }

    /* MOBILE */
    @media (max-width: 991px){
        .home-hero{
            padding-top:120px;
            text-align:center;
        }

        .hero-img{
            position:static;
            transform:none;
            max-height:320px;
            margin:30px auto 0;
            display:block;
        }

        .navbar{
            background:#fff;
        }

        .navbar-collapse{
            background:#fff;
            margin-top:15px;
            padding:20px;
            border-radius:12px;
            box-shadow:0 12px 30px rgba(0,0,0,.15);
        }

        .navbar-nav{
            flex-direction: column;
            gap:12px !important;
            margin-left: 0;
        }

        .navbar-nav .nav-link{
            padding:10px 0;
            font-size:15px;
            border-bottom:1px solid #eee;
        }

        .navbar-nav .nav-item:last-child .nav-link{
            border-bottom:none;
        }
    }
    </style>
</head>

<body class="@yield('body-class')">

{{-- ===============================
    NAVBAR
=============================== --}}
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">TASTY FOOD</a>

        <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav gap-4">
                <li class="nav-item"><a class="nav-link" href="/">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kontakKami') }}">KONTAK</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('tentang')}}">TENTANG</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('berita')}}">BERITA</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('galeri')}}">GALERI</a></li>

                @if (!Auth::check())
                    <li class="nav-item"><a class="nav-link" href="/login">LOGIN</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/logout">LOGOUT</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

{{-- CONTENT --}}
@yield('content')

{{-- ===============================
    FOOTER
=============================== --}}
<footer class="footer-dark pt-5">
    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold text-white mb-3">Tasty Food</h5>
                <p class="text-muted small">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                </p>

                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-icon twitter"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-semibold mb-3">Useful links</h6>
                <ul class="list-unstyled footer-link">
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Hewan</a></li>
                    <li><a href="#">Galeri</a></li>
                    <li><a href="#">Testimonial</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-semibold mb-3">Privacy</h6>
                <ul class="list-unstyled footer-link">
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                    <li><a href="#">Servis</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6 class="text-white fw-semibold mb-3">Contact Info</h6>
                <ul class="list-unstyled footer-contact">
                    <li><i class="fa-solid fa-envelope"></i> tastyfood@gmail.com</li>
                    <li><i class="fa-solid fa-phone"></i> +62 812 3456 7890</li>
                    <li><i class="fa-solid fa-location-dot"></i> Bandung, Jawa Barat</li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <p class="text-center text-muted small mb-0">
            Copyright ©2023 All rights reserved
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    });
</script>

</body>
</html>
