<x-app-layout title="Akun" header="Akun">
    <!-- Main row -->
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 mb-3 d-flex justify-content-end">
            <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
        </div>
        <!-- Tabel Kendaraan Aktif -->
        <div class="col-10 mb-5">
            <div class="card text-center">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getAkun as $index => $akun)
                                <tr>
                                    <td>{{ $index + $getAkun->firstItem() }}</td>
                                    <td>{{ $akun->username }}</td>
                                    <td>{{ $akun->name }}</td>
                                    <td>{{ $akun->email }}</td>
                                    <td>
                                        @if ($akun->role->role == 'Admin')
                                            Admin
                                        @elseif($akun->role->role == 'Petugas')
                                            Petugas
                                        @else
                                            Nonrole Akun
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('akun.edit', $akun->user_id) }}" class="d-inline"
                                            method="GET">
                                            <button type="submit" class="btn btn-warning"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </form>

                                        <form action="{{ route('akun.destroy', $akun->user_id) }}" method="POST"
                                            class="d-inline" id="akun.destroy">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash-can"></i></button>
                                        </form>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">
                                        Tidak ada akun
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $getAkun->links() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</x-app-layout>
