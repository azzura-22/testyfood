@extends('layout')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow-lg border-0" style="max-width:400px; width:100%; border-radius:15px;">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <i class="fas fa-utensils fa-3x text-warning mb-2"></i>
                <h3 class="fw-bold text-warning">TestyFood</h3>
                <p class="text-muted">Login ke dashboard</p>
            </div>

            <form action="{{ route('login.auth') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control rounded-pill px-3"
                           placeholder="Masukkan email"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control rounded-pill px-3"
                           placeholder="Masukkan password"
                           required>
                </div>

                <div class="d-grid mt-4">
                    <button class="btn btn-warning rounded-pill text-white fw-bold">
                        Login
                    </button>
                </div>

                <div>
                    <p class="text-center mt-3">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-warning fw-semibold text-decoration-none">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">
                    © {{ date('Y') }} TestyFood
                </small>
            </div>

        </div>
    </div>
</div>
@endsection
