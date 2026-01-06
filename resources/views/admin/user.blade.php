@extends('admin.template')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Data User</h2>

    {{-- 🔍 FILTER & SORT --}}
    <form method="GET" class="row g-2 mb-3">

        <div class="col-md-4 col-12">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari nama / email"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3 col-12">
            <select name="sort" class="form-control">
                <option value="">Terbaru</option>
                <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>
                    Terlama
                </option>
                <option value="name_asc" {{ request('sort')=='name_asc' ? 'selected' : '' }}>
                    Nama A - Z
                </option>
                <option value="name_desc" {{ request('sort')=='name_desc' ? 'selected' : '' }}>
                    Nama Z - A
                </option>
            </select>
        </div>

        <div class="col-md-2 col-12">
            <button class="btn btn-primary w-100">
                Terapkan
            </button>
        </div>

    </form>

    {{-- 📋 TABLE RESPONSIVE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Data user tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $users->withQueryString()->links() }}
    </div>

</div>
@endsection
