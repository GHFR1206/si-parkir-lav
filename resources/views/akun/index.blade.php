<x-app-layout title="Akun" header="Akun">
    <!-- Main row -->
    <div class="row">
        <!-- Tabel Kendaraan Aktif -->
        <div class="col-12 mb-5">
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
                                        @if ($akun->role == 0)
                                            Admin
                                        @else
                                            Petugas
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('akun.edit', $akun->id) }}" class="btn btn-warning"><i
                                                class="fa-solid fa-pen-to-square"></i></a>

                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('akun.destroy').submit();"
                                            class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>

                                            <form action="{{ route('akun.destroy', $akun->id) }}" method="POST"
                                                id="akun.destroy">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">
                                        Belum ada yang parkir
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
