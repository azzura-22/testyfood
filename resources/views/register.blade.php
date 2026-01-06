@extends('layout')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow-lg border-0" style="max-width:420px; width:100%; border-radius:15px;">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <i class="fas fa-user-plus fa-3x text-warning mb-2"></i>
                <h3 class="fw-bold text-warning">TestyFood</h3>
                <p class="text-muted">Daftar akun baru</p>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                           name="name"
                           class="form-control rounded-pill px-3"
                           placeholder="Masukkan nama lengkap"
                           required>
                </div>

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

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control rounded-pill px-3"
                           placeholder="Ulangi password"
                           required>
                </div>

                <div class="d-grid mt-4">
                    <button class="btn btn-warning rounded-pill text-white fw-bold">
                        Register
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-warning fw-semibold text-decoration-none">
                        Login
                    </a>
                </small>
            </div>

            <div class="text-center mt-2">
                <small class="text-muted">
                    © {{ date('Y') }} TestyFood
                </small>
            </div>

        </div>
    </div>
</div>
@endsection
