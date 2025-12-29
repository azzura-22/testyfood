@extends('admin.template')
@section('content')
<div class="card-body table-responsive">
    <table id="kontakTable" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Status</th>
                <th>Dikirim</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($masukan as $k)
            <tr>
                <td>{{ $k->id }}</td>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->email }}</td>

                <td>
                    {{ Str::limit($k->pesan, 80) }}
                </td>

                <td>
                    @if($k->status == 'belum terbaca')
                        <span class="badge bg-warning text-dark">Belum Terbaca</span>
                    @else
                        <span class="badge bg-success">Terbaca</span>
                    @endif
                </td>

                <td>
                    {{ $k->created_at->format('d-m-Y H:i') }}
                </td>

                <td>
                    @if($k->status == 'belum terbaca')
                        <form action="{{ route('admin.kontak.read', $k->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-info btn-sm">
                                Tandai Terbaca
                            </button>
                        </form>
                    @endif
                    {{-- <form action="{{ route('admin.kontak.delete', $k->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form> --}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
